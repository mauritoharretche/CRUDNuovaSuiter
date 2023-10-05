##CRUD Nuova Suite

-   Cree un proyecto de prueba segun la documentacion oficial de laravel 9 y Eloquent
-   En el proceso fui creando los modelos que me indicaron en el mail y agregando uno a uno los CRUD routes con sus controllers y probandolos con POSTMAN
-   Pospuse el manejo de la imagen, el paginado y el login para el final
-   Agregue el forceDelete
-   Hice el filtrado por fechas, y nombre
-   Cree rutas para login y resgistrar usuarios
-   Actualize las rutas de create,delete y update (para Categories y Commerce) para que requieran authenticacion
-   Agregue el chequeo de usuario logueado en el show de Commerce
-   Actualize el store method de CommerceController para que pueda asociar una categoria por id (me costo armar el modelo para que funcione)
-   Ya con el modelo funcionando, hice el filtrado por categorias en el index
-   El paginado, vi que habia varias librerias para implementarlo pero tenia cambiar bastante la implementacion y no me daban los tiempos.




Lo que falta:
-   Soportar las imagenes para los comercios
-   Agregar factories para los modelos
-   Tests
