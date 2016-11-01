# Outils et trucs pratiques 

## Sublime Text 
Notre editor favoris 
https://www.sublimetext.com/3

## orgmode for Sublime Text 2 & 3
https://github.com/danielmagnussons/orgmode
ex : 
* ouvrez /docs/roadmap.org
* Ctrl+Shift+P, tapez orgmode

## markdown-live
Visualiser en direct l'edition d'un MD
Editer Save > prévisualisé directement dans le navigateur
https://github.com/mobily/markdown-live#installation
### install
sudo npm install -g markdown-live
petit bug reglé par ca 
echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p
###usage
mdlive --file modules/communecter/docs/devLog.md
mdlive --dir modules/communecter/docs