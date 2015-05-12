<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class ApiController extends Controller {

    const moduleTitle = "API Communecter";
    public static $moduleKey = "communecter";
    
    public $sidebar1 = array(
            array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggle('scenario')","hide"=>true, "iconClass"=>"fa fa-list",
                "blocks"=>array(
                    array("label"=>"Inscription / Creation","iconClass"=>"fa fa-user",
                        "children"=>array(
                            "se communecter == remplir un email + cp = referencement mais pas de zone privée ",
                            "creer son compte privé = personnalisation",
                            "parrainage :: inviter un voisin ou une connaissance ou une entité, creer du lien",
                            "boule de neige social = utiliser les reseau sociau pour inviter ",
                            "un citoyen peut creer une entité (Gpe. , Ass. , Ent., Cit. )",
                        )),
                    array("label"=>"Actualité","iconClass"=>"fa fa-list",
                        "children"=>array(
                            "Ceci deviendra un module dans le PH",
                            "tout element qui depasse un niveau de vote peut devenir une actualité",
                            "un push de la commune",
                            "un push citoyen",
                        )),
                    array("label"=>"Agreggateur de RSS","iconClass"=>"fa fa-rss",
                        "children"=>array(
                            "Ceci deviendra un module dans le PH",
                            "tout type peut ajouter un RSS local :: contenu concernant le CP (concert, mairie, restaurant...)",
                            "visualisation de tous les flux aggregé",
                            "filtre par tag",
                            "filtre chronologique",
                            "filtre par fournisseur : voir que les infos d'un fournisseur",
                        )),
                    array("label"=>"Conseil de quartier","iconClass"=>"fa fa-group",
                        "children"=>array(
                            "Ceci deviendra un module dans le PH",
                            "proposer un ordre du jour",
                            "un ordre du jour peut etre voté",
                            "les ordres du jours les plus voté seront présenter durant le conseil de quartier ",
                            "?? comment intégrer Loomio en paralele avec le PH",
                        )),
                    array("label"=>"Annuaire Locale","iconClass"=>"fa fa-bullhorn",
                        "children"=>array(
                            "Ceci deviendra un module dans le PH",
                            "listing mixitup des acteurs locaux : asso,entr,service public...",
                            "tout type peut ajouter une entité à l'annuaire doit concerner le CP",
                            "une entité peut etre voté",
                            "network mapping local",
                            "creer du lien "
                        )),
                    array("label"=>"Agenda Locale","iconClass"=>"fa fa-bullhorn",
                        "children"=>array(
                            "Ceci deviendra un module dans le PH",
                            "tout type peut ajouter une date local :: contenu concernant le CP (concert, elections, rencontre...)",
                        )),
                    array("label"=>"Communication","iconClass"=>"fa fa-bullhorn",
                        "children"=>array(
                            "System de notification PH > tout le monde",
                            "System de notification PH > une commune",
                            "commune > to administré",
                            "quartier > to administré",
                            "Citoyen to Commune",
                            "Citoyen to Secteur de commune",
                            "Citoyen to Group, Citoyen doit appartenir a l'entité",
                        )),
                    array("label"=>"Administration Commune","iconClass"=>"fa fa-cogs",
                        "children"=>array(
                            "Voir le nombres de citoyen",
                            "Voir le temps de frequentation",
                            "Comptabiliser les contributions"
                            )),
                    array("label"=>"Administration PH","iconClass"=>"fa fa-cogs",
                        "children"=>array(
                            "Voir le nombres de citoyen",
                            "Voir le temps de frequentation",
                            "Comptabiliser les contributions"
                            )),
                    array("label"=>"Visualisation","iconClass"=>"fa fa-eye",
                        "children"=>array(
                            "Ma commune",
                            "Voir l'activité de ma region",
                            )),
                )),
            array('label' => "User", "key"=>"user", "iconClass"=>"fa fa-user", 
                "children"=> array(
                    array( "label"=>"se Communecter","href"=>"javascript:;","onclick"=>"scrollTo('#blockCommunect')",),
                    array( "label"=>"Login","href"=>"javascript:;","onclick"=>"scrollTo('#blockLogin')",),
                    array( "label"=>"Save User","href"=>"javascript:;","onclick"=>"scrollTo('#blockSaveUser')"),
                    array( "label"=>"Get User","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"ConfirmUserRegistration","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')"),
                    array( "label"=>"InvitePeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockinviteUser')"),
                    array( "label"=>"GetNodeByType","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetnodeby')")
                )),
            array('label' => "Entities", "key"=>"entities", "iconClass"=>"fa fa-group",
                "children"=> array(
                    array( "label"=>"Save Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveGroup')"),
                    array( "label"=>"GetGroup","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetgroup')"),
                    array( "label"=>"linkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"unlinkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"get Groups By","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetGroups')")
                )),
            array('label' => "Actualité", "key"=>"news", "iconClass"=>"fa fa-list ", 
                "children"=> array(
                    array( "label"=>"Create News","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveNews')"),
                    array( "label"=>"Make as News","href"=>"javascript:;","onclick"=>"scrollTo('#blockmakeAsNews')"),
                    array( "label"=>"Admin confirm News","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminConfirmNews')"),
                )),
            array('label' => "RSS", "key"=>"rss", "iconClass"=>"fa fa-rss", 
                "children"=> array(
                    array( "label"=>"Add Feed","href"=>"javascript:;","onclick"=>"scrollTo('#blockaddFeed')"),
                    array( "label"=>"Admin confirm Feed","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminConfirmFeed')"),
                )),
            
            array('label' => "Conseil de quartier", "key"=>"groupCommunication", "iconClass"=>"fa fa-group", 
                "children"=> array(
                    array( "label"=>"Create Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveQuartier')"),
                    array( "label"=>"Soumettre une Entrée","href"=>"javascript:;","onclick"=>"scrollTo('#blocksoumettreEntry')"),
                    array( "label"=>"Vote sur une Entrée","href"=>"javascript:;","onclick"=>"scrollTo('#blockvoteEntry')"),
                    array( "label"=>"Déclaré un Admin","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveAdmin')"),
                    array( "label"=>"Admin confirm Entry","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminConfirmFeed')"),
                )),
            array('label' => "Annuaire Locale", "key"=>"directory", "iconClass"=>"fa fa-th-list", 
                "children"=> array(
                    array( "label"=>"get Groups By","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetGroups')"),
                    array( "label"=>"entityConnect","href"=>"javascript:;","onclick"=>"scrollTo('#blockconnectUserEntity')"),
                )),
            array('label' => "Agenda Locale", "key"=>"agenda", "iconClass"=>"fa fa-calendar", 
                "children"=> array(
                    array( "label"=>"Get Dates By","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetDatesBy')"),
                    array( "label"=>"Add Date","href"=>"javascript:;","onclick"=>"scrollTo('#blockaddDate')"),
                    array( "label"=>"Admin confirm Entry","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminConfirmEntry')"),
                )),
            array('label' => "Administration Commune", "key"=>"adminCommune", "iconClass"=>"fa fa-cog", 
                "children"=> array(
                    array( "label"=>"Get Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetDatesBy')"),
                    array( "label"=>"Set Admin Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminQuartier')"),
                )),
            array('label' => "Administration PH", "key"=>"adminPH", "iconClass"=>"fa fa-cogs", 
                "children"=> array(
                    array( "label"=>"Set Admin Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminQuartier')"),
                )),
            array('label' => "Communication", "key"=>"communications", "iconClass"=>"fa fa-bullhorn", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"javascript:;","onclick"=>"scrollTo('#blocksendMessage')")
                )),
        );
    public $percent = 60; //TODO link it to unit test
    protected function beforeAction($action)
  {
    array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th", "menuOnly"=>true,"children"=>PH::buildMenuChildren("applications") ));
    return parent::beforeAction($action);
  }
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	
    public function actions()
    {
        return array(
            //user api
            'login'     =>'ctk.controllers.user.LoginAction',
            'sendemailpwd' => 'ctk.controllers.user.SendEmailPwdAction',
            //open data api
            'getcountries' => 'ctk.controllers.openData.GetCountriesAction',
            'getcitiesbypostalcode' => 'ctk.controllers.openData.GetCitiesByPostalCodeAction',
            //TODO SBAR - cleanup - Is it used ? 
            'saveuser'  =>'ctk.controllers.user.SaveUserAction',
            'communect' => 'ctk.controllers.user.CommunectAction',
            'getuser'   => 'ctk.controllers.user.GetUserAction',
            'getpeopleby'   => 'ctk.controllers.user.GetPeopleByAction',
            'inviteuser'   => 'ctk.controllers.user.InviteUserAction',
            'getnodeby'   => 'ctk.controllers.user.GetNodeByAction',
            'saveuserimages' => 'ctk.controllers.user.SaveUserImagesAction',
            'index'     => 'ctk.controllers.IndexAction',
            //Not used anymore ? The groups has been replaced by organization
            'savegroup'   => 'ctk.controllers.groups.SaveGroupAction',  
            'getgroupsby'   => 'ctk.controllers.groups.GetGroupsByAction',  
            'getuserimages' => 'ctk.controllers.user.getUserImagesAction',
            'sendmessage'   => 'ctk.controllers.messages.SendMessageAction',  
        );
    }
}