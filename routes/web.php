 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController; 
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Frontend\ContactController; 
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\VendorOrderController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[IndexController::class,'Index'])->name('home');


Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store',[UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout',[UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password',[UserController::class, 'UserUpdatePassword'])->name('user.update.password');

}); //Group middleware end



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

////Admin Dashboard
Route::middleware(['auth','role:admin'])->group(function(){
Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/admin/logout',[AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store',[AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/update/password',[AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

////Vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function(){
Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
Route::get('/vendor/logout',[VendorController::class, 'VendorDestroy'])->name('vendor.logout');
Route::get('/vendor/profile',[VendorController::class, 'VendorProfile'])->name('vendor.profile');
Route::post('/vendor/profile/store',[VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
Route::get('/vendor/change/password',[VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
Route::post('/vendor/update/password',[VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');



    /// Vendor Add Product All Route
    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/vendor/all/product','VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product','VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/subcategory/ajax/{category_id}','VendorGetSubCategory');
        Route::post('/vendor/store/product','VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}','VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product','VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail','VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/vendor/update/product/multiImage','VendorUpdateProductMultiImage')->name('vendor.update.product.multiImage');
        Route::get('/vendor/product/multiImage/delete/{id}','VendorMultiImageDelete')->name('vendor.product.multiImg.delete');
        Route::get('/vendor/product/inactive/{id}','VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/venodr/product/active/{id}','VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}','VendorDeleteProduct')->name('vendor.delete.product');

    
    });


    Route::controller(VendorOrderController::class)->group(function(){
        
        Route::get('vendor/pending/order','VendorPendingOrder')->name('vendor.pending.order');

        Route::get('/vendor/order/details/{order_id}','VendorOrderDetails')->name('vendor.order.details');

        Route::get('/vendor/delivered/order' , 'VendorDeliveredOrder')->name('vendor.delivered.order');

        Route::get('vendor/processing/delivered/{order_id}' , 'VendorProcessToDelivered')->name('vendor.processing-delivered');

        Route::get('/vendor/invoice/download/{order_id}' , 'VendorInvoiceDownload')->name('vendor.invoice.download');
    
    });


});/// End Vendor middleware




Route::middleware(['auth','role:admin'])->group(function(){

    ////Category All Route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });


    ////SubCategory All Route
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
    });


    ////Vendor Active And Inactive All Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}','InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve','ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}','ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve','InactiveVendorApprove')->name('inactive.vendor.approve');

    });


    ////Product All Route
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product','AllProduct')->name('all.product');
        Route::get('/add/product','AddProduct')->name('add.product');
        Route::post('/store/product','StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}','EditProduct')->name('edit.product');
        Route::post('/update/product','UpdateProduct')->name('update.product');
        Route::post('/update/product/thambnail','UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiImage','UpdateProductMultiImage')->name('update.product.multiImage');
        Route::get('/product/multiImage/delete/{id}','MultiImageDelete')->name('product.multiImg.delete');
        Route::get('/product/inactive/{id}','ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}','ProductActive')->name('product.active');
        Route::get('/delete/product/{id}','DeleteProduct')->name('delete.product');


    });



    //////Slider All Route
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider','AllSlider')->name('all.slider');
        Route::get('/add/slider','AddSlider')->name('add.slider');
        Route::post('/store/slider','StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
        Route::post('/update/slider','UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}','DeleteSlider')->name('delete.slider');
        
    });


    //////Contact All Route
    Route::controller(ContactController::class)->group(function(){
        
        Route::get('/all/message','AllMessage')->name('all.message');
        Route::get('/delete/message/{id}','DeleteMessage')->name('delete.message');
        Route::get('/reply/message/{id}','ReplyMessage')->name('reply.message');
        Route::post('/store/replymessage/','StoreReplyMessage')->name('store.replymessage');

        Route::get('/all/replymessage/','AllReplyMessage')->name('all.replymessage');
        Route::get('/delete/replymessage/{id}','DeleteReplyMessage')->name('delete.replymessage');


    });


    //////Order All Route
    Route::controller(OrderController::class)->group(function(){
        
        Route::get('/pending/order','PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}','AdminOrderDetails')->name('admin.order.details');

        Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');

        Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');

        Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload')->name('admin.invoice.download');
    

    });


}); // End Admin Middleware

Route::get('/admin/login',[AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login',[VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor',[VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register',[VendorController::class, 'VendorRegister'])->name('vendor.register');



/// Frontend Product Details Route
Route::get('/product/details/{id}/{slug}',[IndexController::class,'ProductDetails']);
Route::get('/vendor/details/{id}',[IndexController::class,'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all',[IndexController::class,'VendorAll'])->name('vendor.all');
Route::get('/product/category/{id}/{slug}',[IndexController::class,'CatWiseProduct']);
Route::get('product/subcategory/{id}/{slug}',[IndexController::class,'SubCatWiseProduct']);



Route::middleware(['auth','role:user'])->group(function(){

    Route::controller(CartController::class)->group(function(){

        // add to cart store data 
        Route::post('/cart/data/store/{id}/','AddToCart');
        
        // view cart details
        Route::get('/mycart','MyCart')->name('mycart');

        Route::get('/delete/cart/{id}','DeleteCart')->name('delete.cart');

        // checkout page route
        Route::get('/checkout/{AllTotal}','CheckoutCreate')->name('checkout');

    });


    Route::controller(StripeController::class)->group(function(){
        Route::post('/stripe/order' , 'StripeOrder')->name('stripe.order');
        Route::post('/cash/order' , 'CashOrder')->name('cash.order');
    

    }); 


    Route::controller(AllUserController::class)->group(function(){

        Route::get('/user/account/page','UserAccount')->name('user.account.page');
        
        Route::get('/user/change/password','UserChangePassword')->name('user.change.password');
        
        Route::get('/user/order/page','UserOrderPage')->name('user.order.page');
        
        Route::get('/reply/page','ReplyMessagePage')->name('reply.message.page');
        
        Route::get('/user/order_details/{order_id}','UserOrderDetails');
        
        Route::get('/user/invoice_download/{order_id}','UserOrderInvoice');

    });


}); // End User Middleware


Route::controller(IndexController::class)->group(function(){
        
    Route::get('/category/all','CategoryAll')->name('category.all');

    Route::get('/user/contact/page','ContactPage')->name('user.contact.page');

    Route::post('/store/contact','StoreContact')->name('store.contact');

    Route::post('/search' , 'ProductSearch')->name('product.search'); 

    // Route::post('/search' , 'ProductSearch')->name('product.search'); 

    Route::get('/about/us/page','AboutPage')->name('about.us.page');

});

Route::controller(ReviewController::class)->group(function(){

    Route::post('/store/review' , 'StoreReview')->name('store.review'); 
    Route::get('/pending/review' , 'PendingReview')->name('pending.review'); 
    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve'); 
    Route::get('/publish/review' , 'PublishReview')->name('publish.review'); 
    Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete');

});
    