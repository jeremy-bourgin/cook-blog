Nom & Prénom des participants au projet :
- BOURGIN Jérémy

Compte et accès :
- url du site : https://bourgin-jeremy-blog.herokuapp.com/
- url vers la panel admin : http://bourgin-jeremy-blog.herokuapp.com/c05f5b3e/admin/
- compte admin : 
    > login : cgi
    > mdp : france

Appréciation sur le cours pour l’année suivante:
- Le cours est clair, rien dire

Commentaires :
- j'ai implémenté un système d'article et de page un peu dans le même style que Wordpress/Drupal (les pages seront donc dans la barre de navigation, et les articles sont listés et paginés sur la page d'accueil). De plus, on peut poster (et supprimer pour les administrateurs) des commentaires sur les articles.
- j'ai utilisé webpack sur lequel j'ai utilisé Bootstrap couplé à Sass (le site est donc responsive). Cela permet de pouvoir déployer du javascript/css (minifié) avec les différentes "vendor" en faisant du versioning. 
- j'ai utilisé le bundle FosUser comme demandé. Cependant, j'ai codé la partie permettant de rajouter un utilisateur depuis le panel admin (plutôt que de surcharger le formulaire d'inscription). En effet, si l'on devait avoir un formulaire pour l'inscription, et un formulaire pour pouvoir ajouter des utilisateurs depuis le panel admin en surchargeant le formulaire d'inscription, cela engendre des complications (par exemple, si la validation pour email est activée, comment fait-on ?). En revanche, pour le formulaire d'inscription j'ai simplement surchargé le template pour personaliser l'affichage de celui-ci.
- en ce qui concerne la sécurité, j'ai bien protégé les routes menant au panel admin. De plus, j'ai ajouté une partie générée aléatoirement (que j'ai ajouté dans la configuration pour éviter de la retaper dans toutes les routes en question) dans la route menant vers le panel admin afin que celle-ci soit difficilement devinable. J'ai aussi interdit que d'autres sites mettent mon site dans une iframe (clickjacking : voir .htaccess). Enfin, pour la validation des formulaires, j'ai bien ajouté toutes les restrcitions nécessaires dans les entitiés.
- j'ai utilisé le bundle CKEditor en le couplant avec webpack (ce qui est beaucoup mieux pour l'affichage et le déploiement) afin que le contenu rédigé dans un article/page soit sous la forme d'un WYSIWYG (avec la possibilité d'écrire directement du HTML).
- j'ai ajouté un système de configuration permettant de pouvoir configurer rapidement et simplement le site. Pour cela, j'ai créé des commandes (comme le préconise symfony : https://symfony.com/doc/4.3/console.html) afin de pouvoir ajouter/modifier/supprimer des configurations. Dans le panel admin, on ne peut que modifier la valeur d'une configuration. Ainsi, on peut via le panel admin changer le titre du site, activer/désactiver des fonctionalités, etc... Enfin, afin que le déploiement n'engendre pas d'erreur, il y a une commande permettant de créer les configurations nécessaires au fonctionnement du site (uniquement pour les configurations qui ne sont pas inscrites dans la BDD). Cette commande a été ajouté dans "post-install-cmd" du fichier composer.
- j'ai traduit le site en français et en anglais (sauf les pages et les articles). L'utilisateur pourra donc choisir via la barre de navigation de mettre le site en français ou en anglais (qui sera sauvegardé). Pour cela, j'ai créé un subscriber (App\EventSubscriber\LocaleSubscriber).
- j'ai créé un autre subscriber permettant de rajouter en variable globale toutes les configurations, et toutes les pages (car elles doivent être affichées dans la barre de navigation). De plus, en utilisant l'interface "App\EventSubscriber\Interfaces\IHasAllPagesSubscriber" couplé au trait "App\EventSubscriber\Traits\AllPagesSubscriberTrait" un controller possèdera toutes les pages (cela permet d'éviter de refaire une requête SQL pour ça).
- j'ai surchargé les erreurs HTTP de twig afin qu'elle s'intègre correctement dans le site.

Ce qui n'a pas bien fonctionné :
- uploader des fichiers sur Heroku n'est pas une bonne idée puisque celui-ci les supprime régulièrement et à chaque déploiement. Cependant, on pourrait les stocker en BDD mais cela n'est pas une bonne idée puisque nous avons peu d'espace dessus. Heroku préconise donc d'utiliser un service externe comme AWS.
- je ne sais pas pourquoi, mais utiliser la fonction localizeddate disponible dans "twig_extension" n'a pas permit d'afficher les dates dans le format local sur Heroku (alors qu'en local cela fonctionne bien).
