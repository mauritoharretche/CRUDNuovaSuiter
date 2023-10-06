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



- Idea de como poder realizar el soporte de las imagenes para los comercios. (no pude llevarla a cabo).
1. Crear imodelo para imagen y migracion
2. correr migracion
3. Relacionar el modelo Commerce con la imagen, Es igual a como se relaciona el commerce con la caegoria
4. Hacer una nueva ruta POST /api/images para crear imagenes,
5. Hacer un nuevo controller para implementar el store, que guarde la imagen en el disco, cree la entrada en la dbm retorne el id
6. Modificar el store method del CommerceController para que soporte un campo imagen, el cual es el id de una imagen
7. Modificar el show y list del commerce controller para que retorne la url de la imagen