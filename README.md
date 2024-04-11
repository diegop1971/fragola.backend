Ecommerce para curriculum

* Programado en PHP utilizando el framework Laravel 10 Fortify Sanctum.

* La base de datos está hecha con Mysql, estoy tratando de tener tablas lo mas normalizadas posibles para el estado actual del proyecto, 
  tuve mucho cuidado en la integridad referencial entre tablas para garantizar la coherencia de los datos.

* Uso de UUID (quedan algunos id autonuméricos en algunas tablas secundarias pero los estoy modificando).

* Para la arquitectura de la aplicacion hice mi interpretación (creo que está bastante bien lograda) de la "arquitectura hexagonal",  en conjunto con un diseño
  dirigido por dominio (DDD).

* La eleccion de esta arquitectura y el uso de la inyección de dependencias por inversión de control hacen que la aplicación esté 
  altamente desacoplada del framework y altamente desacoplada entre las capas que la componen.  

* Uso de "Data Transfer Object" (DTO) y "command handlers". 
 
* Intenté programarla siguiendo principios solid, patrones de diseño y las mejores prácticas de programacion posibles.

* A grandes rasgos el proyecto esta compuesto por dos aplicaciones independientes:
    
    * En Php Laravel:
        * Backend: 
            * Backoffice: que manejará todo lo relacionado con la administración del sitio.
        
            * Frontoffice: que se encargará de gestionar todas las operaciones relacionadas con los customers, desde la elección y compra de un producto, 
            pasando por el pago, seguimiento del envío, y la gestion de su propia cuenta.
    

* En que punto está el proyecto:
    * Estoy modificando el código para que los end points puedan servir a una MPA (originalmente estaba programando tanto el frontend como el backend en Laravel).

    * Funcionalidades del backoffice y el frontoffice:
        Por ahora solo existen funcionalidades básicas ya que me enfoqué mas en la arquitectura de la aplicación que en lo que va a hacer, ya que es 
        infinitamente mas sencillo agregar funcionalidades que cambiar de arquitectura.

        * Backoffice: 
            * abm de categorias, abm de productos, abm de stock, mas complejo y controlado por servicios de dominio
        * Frontoffice
            * Agregar producto al carrito (de a un producto a la vez en el home).
            * En el carrito de compras se puede modificar la cantidad por ítem o eliminar el o los productos deseados.
            * En el carrito de compras se calculan de manera reactiva los subtotales y toales mediante Vue Option API.
            * La información del carro de compras se guarda en sesion.

Estructura de la aplicación en su estado actual:

```application
│  │  ├
│  │  ├─ Controllers
│  │  │  ├─ Auth
│  │  │  │  ├─ ConfirmPasswordController.php
│  │  │  │  ├─ ForgotPasswordController.php
│  │  │  │  ├─ LoginController.php
│  │  │  │  ├─ RegisterController.php
│  │  │  │  ├─ ResetPasswordController.php
│  │  │  │  └─ VerificationController.php
│  │  │  ├─ Backoffice
│  │  │  │  ├─ Categories
│  │  │  │  │  ├─ CategoriesGetController.php
│  │  │  │  │  ├─ CategoryCreateController.php
│  │  │  │  │  ├─ CategoryDeleteController.php
│  │  │  │  │  ├─ CategoryEditController.php
│  │  │  │  │  ├─ CategoryGetController.php
│  │  │  │  │  ├─ CategoryStoreController.php
│  │  │  │  │  └─ CategoryUpdateController.php
│  │  │  │  ├─ Products
│  │  │  │  │  ├─ ProductCreateController.php
│  │  │  │  │  ├─ ProductDeleteController.php
│  │  │  │  │  ├─ ProductEditController.php
│  │  │  │  │  ├─ ProductGetController.php
│  │  │  │  │  ├─ ProductsGetController.php
│  │  │  │  │  ├─ ProductStoreController.php
│  │  │  │  │  └─ ProductUpdateController.php
│  │  │  │  └─ Stock
│  │  │  │     ├─ DeleteStockMovementController.php
│  │  │  │     ├─ EditStockMovementController.php
│  │  │  │     ├─ GetStockMovementController.php
│  │  │  │     ├─ GetStockMovementsController.php
│  │  │  │     ├─ StockUpdateController.php
│  │  │  │     └─ StoreStockMovementController.php
│  │  │  ├─ Controller.php
│  │  │  └─ Frontoffice
│  │  │     ├─ Cart
│  │  │     │  ├─ AddToCartController.php
│  │  │     │  ├─ AsyncShowCartController.php
│  │  │     │  ├─ CartGetController.php
│  │  │     │  ├─ CartItemDeleteController.php
│  │  │     │  ├─ CartItemQuantityController.php
│  │  │     │  └─ DeleteCartController.php
│  │  │     ├─ Home
│  │  │     │  ├─ GetHomeBestsellingProductsController.php
│  │  │     │  ├─ GetHomeFeaturedProductsController.php
│  │  │     │  ├─ GetHomeOnSaleProductsController.php
│  │  │     │  └─ GetProductsCardListController.php
│  │  │     ├─ OrderManager
│  │  │     ├─ Product
│  │  │     │  └─ ProductController.php
│  │  │     └─ ProductList
│  │  │        └─ ProductListGetController.php
│  │  └─ Kernel.php
│  │
├─ database
│  ├─ factories
│  │  ├─ CategoryFactory.php
│  │  ├─ ProductFactory.php
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 2014_10_12_000000_create_users_table.php
│  │  ├─ 2014_10_12_100000_create_password_resets_table.php
│  │  ├─ 2014_10_12_100000_create_password_reset_tokens_table.php
│  │  ├─ 2019_08_19_000000_create_failed_jobs_table.php
│  │  ├─ 2019_12_14_000001_create_personal_access_tokens_table.php
│  │  ├─ 2023_06_14_100211_create_categories_table.php
│  │  ├─ 2023_06_14_120013_create_products_table.php
│  │  ├─ 2023_07_12_174241_create_stock_movement_types_table.php
│  │  ├─ 2023_07_12_178056_create_stock_movements_table.php
│  │  ├─ 2023_09_10_175803_create_order_status_types_table.php
│  │  ├─ 2023_09_10_176445_create_orders_table.php
│  │  ├─ 2023_09_12_100315_create_currencies_table.php
│  │  ├─ 2023_09_12_174801_create_product_prices_table.php
│  │  └─ 2023_09_12_174814_create_product_price_history_table.php
│  └─ seeders
│     ├─ CategorySeeder.php
│     ├─ DatabaseSeeder.php
│     ├─ OrderStatusTypeSeeder.php
│     ├─ ProductSeeder.php
│     └─ StockMovementsTypeSeeder.php
├─ src
│  ├─ backoffice
│  │  ├─ Categories
│  │  │  ├─ Application
│  │  │  │  ├─ Create
│  │  │  │  │  ├─ CategoryCreator.php
│  │  │  │  │  ├─ CreateCategoryCommand.php
│  │  │  │  │  └─ CreateCategoryCommandHandler.php
│  │  │  │  ├─ Delete
│  │  │  │  │  ├─ CategoryDeleter.php
│  │  │  │  │  ├─ DeleteCategoryCommand.php
│  │  │  │  │  └─ DeleteCategoryCommandHandler.php
│  │  │  │  ├─ Find
│  │  │  │  │  ├─ CategoriesGet.php
│  │  │  │  │  └─ CategoryFinder.php
│  │  │  │  └─ Update
│  │  │  │     ├─ CategoryUpdater.php
│  │  │  │     ├─ UpdateCategoryCommand.php
│  │  │  │     └─ UpdateCategoryCommandHandler.php
│  │  │  ├─ Domain
│  │  │  │  ├─ Category.php
│  │  │  │  ├─ CategoryEnabled.php
│  │  │  │  ├─ CategoryId.php
│  │  │  │  ├─ CategoryName.php
│  │  │  │  ├─ CategoryNotExist.php
│  │  │  │  ├─ CategoryRepository.php
│  │  │  │  └─ Providers
│  │  │  │     └─ CategoryServiceProvider.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           ├─ EloquentCategoryModel.php
│  │  │           └─ EloquentCategoryRepository.php
│  │  ├─ OrderManager
│  │  │  ├─ Application
│  │  │  ├─ Domain
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           └─ OrderEloquentModel.php
│  │  ├─ OrderStatusTypes
│  │  │  ├─ Application
│  │  │  ├─ Domain
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           └─ OrderStatusTypeEloquentModel.php
│  │  ├─ ProductPrices
│  │  │  ├─ Application
│  │  │  ├─ Domain
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           └─ ProductPricesEloquentModel.php
│  │  ├─ ProductPricesHistory
│  │  │  ├─ Application
│  │  │  ├─ Domain
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           └─ ProductPricesHistoryEloquentModel.php
│  │  ├─ Products
│  │  │  ├─ Application
│  │  │  │  ├─ Create
│  │  │  │  │  ├─ CreateProductCommand.php
│  │  │  │  │  ├─ CreateProductCommandHandler.php
│  │  │  │  │  └─ ProductCreator.php
│  │  │  │  ├─ Delete
│  │  │  │  │  ├─ DeleteProductCommand.php
│  │  │  │  │  ├─ DeleteProductCommandHandler.php
│  │  │  │  │  └─ ProductDeleter.php
│  │  │  │  ├─ Find
│  │  │  │  │  ├─ ProductFinder.php
│  │  │  │  │  └─ ProductsGet.php
│  │  │  │  └─ Update
│  │  │  │     ├─ ProductUpdater.php
│  │  │  │     ├─ UpdateProductCommand.php
│  │  │  │     └─ UpdateProductCommandHandler.php
│  │  │  ├─ Domain
│  │  │  │  ├─ Product.php
│  │  │  │  ├─ ProductDescription.php
│  │  │  │  ├─ ProductDescriptionShort.php
│  │  │  │  ├─ ProductEnabled.php
│  │  │  │  ├─ ProductId.php
│  │  │  │  ├─ ProductLowStockAlert.php
│  │  │  │  ├─ ProductLowStockThreshold.php
│  │  │  │  ├─ ProductMinimumQuantity.php
│  │  │  │  ├─ ProductName.php
│  │  │  │  ├─ ProductNotExist.php
│  │  │  │  ├─ ProductRepository.php
│  │  │  │  ├─ ProductUnitPrice.php
│  │  │  │  └─ Providers
│  │  │  │     └─ ProductServiceProvider.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        ├─ Eloquent
│  │  │        │  ├─ EloquentProductRepository.php
│  │  │        │  └─ ProductEloquentModel.php
│  │  │        └─ RawSql
│  │  ├─ Stock
│  │  │  ├─ Application
│  │  │  │  ├─ Create
│  │  │  │  │  ├─ CreateStockCommand.php
│  │  │  │  │  ├─ CreateStockCommandHandler.php
│  │  │  │  │  └─ StockCreator.php
│  │  │  │  ├─ Delete
│  │  │  │  │  ├─ DeleteStockCommand.php
│  │  │  │  │  ├─ DeleteStockCommandHandler.php
│  │  │  │  │  └─ StockDeleter.php
│  │  │  │  ├─ Find
│  │  │  │  │  ├─ StockFinder.php
│  │  │  │  │  └─ StockGet.php
│  │  │  │  └─ Update
│  │  │  │     ├─ StockUpdater.php
│  │  │  │     ├─ UpdateStockCommand.php
│  │  │  │     └─ UpdateStockCommandHandler.php
│  │  │  ├─ Domain
│  │  │  │  ├─ Interfaces
│  │  │  │  │  ├─ StockAvailabilityServiceInterface.php
│  │  │  │  │  ├─ StockMovementTypeCheckerServiceInterface.php
│  │  │  │  │  ├─ StockQuantitySignHandlerServiceInterface.php
│  │  │  │  │  ├─ StockRepositoryInterface.php
│  │  │  │  │  └─ StockValidateQuantityGreaterThanZeroServiceInterface.php
│  │  │  │  ├─ Providers
│  │  │  │  │  └─ StockServiceProvider.php
│  │  │  │  ├─ Services
│  │  │  │  │  ├─ StockAvailabilityService.php
│  │  │  │  │  ├─ StockMovementTypeCheckerService.php
│  │  │  │  │  ├─ StockQuantitySignHandlerService.php
│  │  │  │  │  └─ StockValidateQuantityGreaterThanZeroService.php
│  │  │  │  ├─ Stock.php
│  │  │  │  ├─ StockNotExist.php
│  │  │  │  └─ ValueObjects
│  │  │  │     ├─ StockDate.php
│  │  │  │     ├─ StockEnabled.php
│  │  │  │     ├─ StockId.php
│  │  │  │     ├─ StockMovementTypeId.php
│  │  │  │     ├─ StockNotes.php
│  │  │  │     ├─ StockProductId.php
│  │  │  │     └─ StockQuantity.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           ├─ EloquentStockModel.php
│  │  │           └─ EloquentStockRepository.php
│  │  └─ StockMovementType
│  │     ├─ Application
│  │     │  └─ Find
│  │     │     ├─ StockMovementTypeFinder.php
│  │     │     └─ StockMovementTypeGet.php
│  │     ├─ Domain
│  │     │  ├─ Providers
│  │     │  │  └─ StockMovementTypeServiceProvider.php
│  │     │  ├─ StockMovementType.php
│  │     │  ├─ StockMovementTypeEnabled.php
│  │     │  ├─ StockMovementTypeId.php
│  │     │  ├─ StockMovementTypeName.php
│  │     │  ├─ StockMovementTypeNotes.php
│  │     │  ├─ StockMovementTypeNotExist.php
│  │     │  └─ StockMovementTypeRepository.php
│  │     └─ Infrastructure
│  │        └─ Persistence
│  │           └─ Eloquent
│  │              ├─ EloquentStockMovementTypeModel.php
│  │              └─ EloquentStockMovementTypeRepository.php
│  ├─ frontoffice
│  │  ├─ Cart
│  │  │  ├─ Application
│  │  │  │  ├─ Delete
│  │  │  │  │  ├─ CartItemDeleter.php
│  │  │  │  │  ├─ DeleteCartItemCommand.php
│  │  │  │  │  └─ DeleteCartItemCommandHandler.php
│  │  │  │  ├─ Find
│  │  │  │  │  └─ CartGet.php
│  │  │  │  └─ Update
│  │  │  │     ├─ CartUpdater.php
│  │  │  │     ├─ UpdateCartCommand.php
│  │  │  │     └─ UpdateCartCommandHandler.php
│  │  │  ├─ Domain
│  │  │  │  ├─ Cart.php
│  │  │  │  ├─ ICartSessionManager.php
│  │  │  │  ├─ Interfaces
│  │  │  │  │  └─ ICartRepository.php
│  │  │  │  ├─ ISessionManager.php
│  │  │  │  ├─ ProductId.php
│  │  │  │  ├─ ProductName.php
│  │  │  │  ├─ ProductQty.php
│  │  │  │  ├─ ProductUnitPrice.php
│  │  │  │  └─ Providers
│  │  │  │     └─ CartSessionServiceProvider.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Session
│  │  │           ├─ CartRepository.php
│  │  │           └─ CartSessionCookieManager.php
│  │  ├─ Categories
│  │  │  ├─ Application
│  │  │  │  └─ Find
│  │  │  │     ├─ CategoriesGet.php
│  │  │  │     └─ CategoryFinder.php
│  │  │  ├─ Domain
│  │  │  │  ├─ CategoryEnabled.php
│  │  │  │  ├─ CategoryId.php
│  │  │  │  ├─ CategoryName.php
│  │  │  │  ├─ CategoryNotExist.php
│  │  │  │  ├─ CategoryRepository.php
│  │  │  │  └─ Providers
│  │  │  │     └─ CategoryServiceProvider.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           ├─ EloquentCategoryModel.php
│  │  │           └─ EloquentCategoryRepository.php
│  │  ├─ Home
│  │  │  ├─ Application
│  │  │  │  └─ Find
│  │  │  │     ├─ GetHomeProducts.php
│  │  │  │     └─ HomeProductFinder.php
│  │  │  ├─ Domain
│  │  │  │  ├─ HomeProductNotExist.php
│  │  │  │  ├─ Interfaces
│  │  │  │  │  └─ HomeProductsRepositoryInterface.php
│  │  │  │  ├─ Providers
│  │  │  │  │  └─ HomeProductServiceProvider.php
│  │  │  │  └─ Services
│  │  │  │     └─ HomeProductsListService.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        └─ Eloquent
│  │  │           ├─ HomeProductEloquentModel.php
│  │  │           └─ HomeProductEloquentRepository.php
│  │  ├─ OrderManager
│  │  ├─ Products
│  │  │  ├─ Application
│  │  │  │  └─ Find
│  │  │  │     ├─ GetEnabledProductsInActiveCategories.php
│  │  │  │     └─ ProductFinder.php
│  │  │  ├─ Domain
│  │  │  │  ├─ ProductDescription.php
│  │  │  │  ├─ ProductEnabled.php
│  │  │  │  ├─ ProductId.php
│  │  │  │  ├─ ProductName.php
│  │  │  │  ├─ ProductNotExist.php
│  │  │  │  ├─ ProductRepository.php
│  │  │  │  ├─ ProductUnitPrice.php
│  │  │  │  └─ Providers
│  │  │  │     └─ ProductServiceProvider.php
│  │  │  └─ Infrastructure
│  │  │     └─ Persistence
│  │  │        ├─ Eloquent
│  │  │        │  ├─ EloquentProductRepository.php
│  │  │        │  └─ ProductEloquentModel.php
│  │  │        └─ RawSql
│  │  │           └─ RawSqlProductRepository.php
│  │  └─ Stock
│  │     ├─ Application
│  │     │  └─ Find
│  │     │     └─ StockFinder.php
   │     ├─ Domain
   │     │  ├─ Interfaces
   │     │  │  └─ StockRepositoryInterface.php
   │     │  ├─ Providers
   │     │  │  └─ StockServiceProvider.php
   │     │  ├─ Services
   │     │  ├─ StockNotExist.php
   │     │  └─ ValueObjects
   │     └─ Infrastructure
   │        └─ Persistence
   │           └─ Eloquent
   │              ├─ EloquentStockModel.php
   │              └─ EloquentStockRepository.php
   └─ Shared
      ├─ Domain
      │  ├─ Bus
      │  │  └─ Command
      │  │     ├─ Command.php
      │  │     ├─ CommandBus.php
      │  │     ├─ CommandHandler.php
      │  │     └─ Container.php
      │  ├─ DomainError.php
      │  ├─ UuidGenerator.php
      │  └─ ValueObject
      │     ├─ BoolValueObject.php
      │     ├─ FloatValueObject.php
      │     ├─ IntValueObject.php
      │     ├─ Stringable.php
      │     ├─ StringValueObject.php
      │     └─ Uuid.php
      └─ Infrastructure
         ├─ Bus
         │  └─ Command
         │     └─ SimpleCommandBus.php
         ├─ CviebrockEloquentSluggable.php
         ├─ LaravelContainer.php
         └─ RamseyUuidGenerator.php```