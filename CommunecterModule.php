<?php
/**
 * Communect Module
 *
 * @author Tibor Katelbach <oceatoon@mail.com>
 * @version 0.0.3
 *
*/

class CommunecterModule extends CWebModule {

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		Yii::app()->setComponents(array(
		    'errorHandler'=>array(
		        'errorAction'=>'/'.$this->id.'/error'
		    )
		));
		
		Yii::app()->homeUrl = Yii::app()->createUrl($this->id);
		
		//Apply theme
		$themeName = $this->getTheme();
		Yii::app()->theme = $themeName;
		
		Yii::app()->language = (isset(Yii::app()->session["lang"])) ? Yii::app()->session["lang"] : 'fr';
		
		// import the module-level models and components
		$this->setImport(array(
			'citizenToolKit.models.*',
			$this->id.'.models.*',
			$this->id.'.components.*',
			$this->id.'.messages.*',
		));
		/*$this->components =  array(
            'class'=>'CPhpMessageSource',
            'basePath'=>'/messages'
        );*/
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	private $_assetsUrl;

	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
	        $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
	            Yii::getPathOfAlias($this->id.'.assets') );
	    return $this->_assetsUrl;
	}

	/**
	 * Retourne le theme d'affichage de communecter.
	 * Si option "theme" dans paramsConfig.php : 
	 * Si aucune option n'est précisée, le thème par défaut est "ph-dori"
	 * Si option 'tpl' fixée dans l'URL avec la valeur "iframesig" => le theme devient iframesig
	 * Si option "network" fixée dans l'URL : theme est à network et la valeur du parametres fixe les filtres d'affichage
	 * @return type
	 */
	public function getTheme() {
		$theme = "ph-dori";
		//$theme = "kgougle";
		if (!empty(Yii::app()->params['theme'])) {
			$theme = Yii::app()->params['theme'];
		} else if (empty(Yii::app()->theme)) {
			$theme = "ph-dori";
			//$theme = "kgougle";
		}

		if(@$_GET["tpl"] == "iframesig"){ $theme = $_GET["tpl"]; }

		if(@$_GET["network"]) {
            $theme = "network";
            //Yii::app()->params['networkParams'] = $_GET["network"];
        }
		return $theme;
	}

	/**
	 * Récupère le fichier de configuration du network et retourne en tableau json
	 * Le fichier de conf peut être en local sur le serveur ou accessible depuis une URL
	 * TODO : Vérifie le bon formatage du fichier
	 * @return json_decode array
	 */
	public function getNetworkParams() {
		$configPath = "";
		if(@$_GET["network"]) {
            Yii::app()->params['networkParams'] = $_GET["network"];
        }
        
        if (empty(Yii::app()->params['networkParams'])) {
			$configPath = "default";
		} else {
			$configPath = Yii::app()->params['networkParams'];
		}
		
		if ( stripos($configPath, "http") != false || stripos($configPath, "https") != false ) {
			error_log("chargement du fichier de config en local");
			$configPath =  Yii::app()->theme->basePath . '/views/layouts/params/'.$configPath.".json";
		}

		try {
			$json = file_get_contents($configPath, null, null, 0, 10000);
			if ($json === false) 
				throw new CHttpException(404, "Impossible to find the network configuration file.");
		} catch (Exception $e) {
    		throw new CHttpException(404, "Error Reading the network configuration file.");
		}

		return json_decode($json, true);
	}
}
