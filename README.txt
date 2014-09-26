DIP (Defacing Identification PHP)

Attraverso DIP, potrai intercettare degli attacchi "Website defacement".

DIP viene rilasciato "così com'è". 

Non posso e non voglio assicurarvi che sia il prodotto definitivo contro questa tipologia di attachi ,semplicemente perchè non lo è.

Mi rendo conto anche che non è del tutto completo, mancano alcune cose necessarie per esempio: 
l'esclusione di directory dinamiche dai controlli (sarà oggetto di un futuro sviluppo).

Lo script principale (Dip_Scan.php) dovrebbe essere schedulato (a vostro piacimento), in modo da effettuare un controllo, ad intervalli di tempo prestabiliti.


Detto ciò vi spiego come configurarlo e come sia semplice il suo utilizzo.

1-Modificare il file di configurazione (cfg.php), inserendo i propri parametri, troverete nel file delle istruzioni spero comprensibili

2-Per la prima esecuzione e solo per la prima, il flag "CREATE_OR_UPDATE" DEVE essere true, terminata la prima esecuzione portarlo a false e lasciarlo così per sempre.

3-eseguire lo script Dip_Scan.php; La prima esecuzione creerà una mappa del filesystem che verrà utilizzata in seguito per i controlli.

Se nel vostro filesystem verrà modificato o inserito o eliminato un file o una cartella, verrete avvisati dell'accaduto nel modo in cui 
avete deciso di essere avvisati (cfg.php).
Ovviamente se sarete voi a modificare il vostro filesystem, dovrete portare il flag "CREATE_OR_UPDATE" a true eseguire un "nuovo primo  lancio" in seguito riportarlo a false.

Spero vi sia utile ;)






********************************************************************************
[English translation by GoogleTranslate, I'm sorry for the mistakes]
********************************************************************************


DIP (Defacing Identification PHP) 

Through DIP, you can intercept the attacks "Website defacement." 

DIP is released "as is". 

I can not and do not want to make sure it is the final product against this type of attacks, simply because it is not. 

I also realize that it is not entirely complete, lacking some necessary things for example: 
the exclusion of directory dynamic controls (it will be the subject of a future development). 

The main script (Dip_Scan.php) should be scheduled (to your liking), so as to carry out a check, for predetermined time intervals. 


Having said this, I will explain how to configure it and how simple its use. 

1-Edit the configuration file (cfg.php), by inserting its own parameters, you will find the instructions in the file I hope to understand 

2-For the first run, only for the first, the flag "CREATE_OR_UPDATE" MUST be true, after the first run take it to false and leave it that way forever. 

3-run the script Dip_Scan.php; The first run will create a map of the file system that will be used later for the controls. 

If your filesystem is modified or inserted or deleted a file or folder, you will be notified of the incident in the way 
you have decided to be notified (cfg.php). 
Obviously if you'll be changing your filesystem, you must bring the flag "CREATE_OR_UPDATE" true to perform a "new first launch" later bring it back to false. 

I hope you find it useful;)







********************************************************************************
[Traducción española de GoogleTranslate, lo siento por los errores de seguridad]
********************************************************************************

DIP (Desfigurar identificación PHP) 

A través de DIP, puede interceptar el ataque "desfiguración sitio web." 

DIP se libera "tal cual". 

No puedo y no quiero para asegurarse de que es el producto final contra este tipo de ataques, simplemente porque no lo es. 

También me doy cuenta de que no es del todo completa, a falta de algunas cosas necesarias, por ejemplo: 
la exclusión de los controles dinámicos de directorio (que será objeto de un desarrollo futuro). 

El script principal (Dip_Scan.php) debe ser programado (a su gusto), a fin de efectuar un control, por intervalos de tiempo predeterminados. 


Dicho esto, voy a explicar cómo configurarlo y cómo sencillo su uso. 

1-Editar el archivo de configuración (cfg.php), mediante la inserción de sus propios parámetros, usted encontrará las instrucciones en el archivo espero entender 

2-Para la primera carrera, sólo para la primera, la bandera "CREATE_OR_UPDATE" DEBE ser verdad, después de la primera carrera llevarlo a falso y dejarlo así para siempre. 

3-ejecutar el Dip_Scan.php guión; La primera carrera será crear un mapa del sistema de archivos que se utilizará más adelante para los controles. 

Si su sistema de archivos se modifica o inserta o elimina un archivo o una carpeta, se le notificará el incidente en el camino 
usted ha decidido que se le notifique (cfg.php). 
Obviamente, si usted va a cambiar su sistema de archivos, debe llevar la bandera "CREATE_OR_UPDATE" true para realizar un "nuevo primer lanzamiento" después traerlo de vuelta a false. 

Espero que les sea útil;)


********************************************************************************
[Traduction française par GoogleTranslate, je suis désolé pour les fautes]
********************************************************************************
DIP (Dégradation identification PHP) 

Grâce DIP, vous pouvez intercepter l'attaque "Site dégradation." 

DIP est libéré "en l'état". 

Je ne peux pas et ne veux pas vous assurer qu'il est le produit final contre ce type d'attaques, tout simplement parce qu'il n'est pas. 

Je me rends compte aussi que ce n'est pas tout à fait complet, manque des choses nécessaires, par exemple: 
l'exclusion de répertoires contrôles dynamiques (ce sera l'objet d'un développement futur). 

Le script principal (Dip_Scan.php) doit être prévu (à votre goût), de manière à effectuer un contrôle, pour des intervalles de temps prédéterminés. 


Cela dit, je vais vous expliquer comment configurer et comment son utilisation simple. 

1 Modifiez le fichier de configuration (cfg.php), en insérant ses propres paramètres, vous trouverez les instructions dans le fichier, je l'espère pour comprendre 

2-Pour la première manche, seulement pour le premier, le drapeau "CREATE_OR_UPDATE" DOIT être vrai, après la première manche prendre pour faux et laisser ainsi pour toujours. 

3-exécuter le script Dip_Scan.php; La première manche va créer une carte du système de fichiers qui sera utilisé plus tard pour les contrôles. 

Si votre système de fichiers est modifié ou ajouté ou supprimé un fichier ou un dossier, vous serez averti de l'incident de la manière 
vous avez décidé d'être notifié (cfg.php). 
Évidemment, si vous serez en train de changer votre système de fichiers, vous devez mettre le drapeau "CREATE_OR_UPDATE" vrai pour effectuer un "nouveau premier lancement" apporter plus tard revenir à faux. 

J'espère qu'elle vous sera utile;)



