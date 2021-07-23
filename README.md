## SDNL LIST

_Paquete en php para el buscar la insidencia de un nombre dentro de la lista sdn 'lista clinton'_

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento._


### Instalación 🔧

_para instalar el paquete ejecute el siguiente comando en consola:_

```
composer require 1026jota/sdn-list
```

_después para publicar el archivo de configuración ejecuta siguiente comando:_

```
php artisan vendor:publish --provider='Jota\SdnList\Providers\SdnListServiceProvider'
```
## USO

```
use Jota\SdnList\Class\SdnList

$list = new SdnList();
$list->search('name to search');
$list->getResult();

```

## Autores ✒️

* **Jofree Alexander Montaño Nieto** - *developer* - [1026jota](https://github.com/1026jota)

## Licencia 📄

Este proyecto está bajo la Licencia (MIT).

---