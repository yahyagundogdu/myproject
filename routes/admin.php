<?php

use App\Http\Controllers\backend\AdminUsersController;
use App\Http\Controllers\backend\AjaxController;
use App\Http\Controllers\backend\AyarlarController;
use App\Http\Controllers\backend\BlogCategoryController;
use App\Http\Controllers\backend\BlogsController;
use App\Http\Controllers\backend\GalleryCategoryController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\ModuleDataController;
use App\Http\Controllers\backend\ModuleEditController;
use App\Http\Controllers\backend\ModulesController;
use App\Http\Controllers\backend\ModulesMakerController;
use App\Http\Controllers\backend\PagesController;
use App\Http\Controllers\backend\ProductsCategoryController;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\ProductsVariantController;
use App\Http\Controllers\backend\RandevuController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SiteSettingsController;
use App\Http\Controllers\backend\SliderController;
use Illuminate\Support\Facades\Route;


Route::get('/',[LoginController::class, 'login'])->name('admin.login');
Route::get('cikis', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('login', [LoginController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware('role:Admin')->group(function () {

    Route::group(['prefix' => 'filemanager', 'middleware' => ['role:Admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

        Route::get('/anasayfa', [HomeController::class, 'index'])->name('admin.dashboard');

        Route::resource('settings', AyarlarController::class)->names([
            'index' => "admin.ayarlar"
        ]);
        Route::resource('site-settings',SiteSettingsController::class)->names([
            'index'=>'siteAyarlari'
        ]);
        Route::post('site-map-generator',[SiteSettingsController::class,'mapGenerator'])->name('siteMapGenerator');
        Route::post('site-cache-clear',[SiteSettingsController::class,'cacheClear'])->name('cacheClear');

        Route::get('settings/delete/{id}', [AyarlarController::class, 'delete']);

        Route::post('getreplacetitle', [AjaxController::class, 'replace'])->name('admin.ajax');

        Route::get('dosyalar', function () {
            return view('backend.pages.file-manager.file-manager');
        })->name('dosyalar');


        Route::post('settings/sortablesettings', [AyarlarController::class, 'sortablesettings']);
        Route::post('settings/deletefile', [AyarlarController::class, 'deletefile'])->name('deletefile');

        Route::prefix('kullanici-islemleri')->group(function () {
            Route::resource('kullanicilar', AdminUsersController::class)->names([
                'index' => 'admin.users',
                'create' => 'admin.newuser',
                'edit' => 'admin.user.edit',
                'update' => 'admin.user.update',
                'store' => 'admin.user.store',
            ]);
            Route::resource('yeni-kullanici', AdminUsersController::class)->names([
                'index' => 'admin.users.new'
            ]);
            Route::resource('roller', RoleController::class)->names([
                'index' => 'admin.role',
                'create' => 'admin.role.create'
            ]);
        });


        Route::get('dosyalar', function () {
            return view('backend.pages.file-manager.file-manager');
        })->name('dosyalar');

        Route::post('settings/sortablesettings', [AyarlarController::class, 'sortablesettings']);
        Route::post('slider/sortablesettings', [SliderController::class, 'sortablesettings']);
        Route::post('settings/deletefile', [AyarlarController::class, 'deletefile'])->name('deletefile');
        Route::post('sayfalar/deletefile', [PagesController::class, 'deletefile'])->name('pageDeleteFile');
        Route::post('sayfalar/featureDelete', [PagesController::class, 'featureDelete'])->name('featureDelete');
        Route::post('sayfalar/featureDeleteImage', [PagesController::class, 'featureDeleteImage'])->name('featureDeleteImage');
        Route::post('sayfalar/deleteAllFeature', [PagesController::class, 'deleteAllFeature'])->name('deleteAllFeature');
        Route::get('sayfalar/siralama', [PagesController::class, 'sortableView'])->name('sortablePages');
        Route::post('sayfalar/siralmakayit', [PagesController::class, 'sortableSave'])->name('sortableSave');
        Route::post('blog-remove', [BlogsController::class,'destroy'])->name('removeBlog');

        Route::resource('blog', BlogsController::class)->names([
            'index' => 'admin.blogs',
            'create' => 'admin.newBlog',
            'edit' => 'admin.blog.edit',
            'update' => 'admin.blog.update',
            'store' => 'admin.blog.store',
        ]);

        Route::resource('slider', SliderController::class)->names([
            'index' => 'admin.slider',
            'create' => 'admin.newSlider',
            'edit' => 'admin.slider.edit',
            'update' => 'admin.slider.update',
            'store' => 'admin.slider.store',
        ]);



        Route::resource('sayfalar', PagesController::class)->names([
            'index' => 'admin.page',
            'create' => 'admin.newPage',
            'edit' => 'admin.page.edit',
            'update' => 'admin.page.update',
            'store' => 'admin.page.store',
            'show' => 'admin.page.show',
        ]);

        Route::resource('kategori', BlogCategoryController::class)->names([
            'index' => 'admin.category',
            'create' => 'admin.category.create',
        ]);

        Route::get('module-name-edit/{id}', [ModulesController::class, 'moduleShow'])->name('module-name-edit');
        Route::resource('modules', ModulesController::class)->names([
            'index' => 'modules',
            'store' => 'modules.create'
        ]);

        Route::post('delete-module-body', [ModulesMakerController::class, 'moduleSortable'])->name('moduleSortable');
        Route::post('delete-module-item', [ModulesMakerController::class, 'destroy'])->name('deleteModuleItem');

        Route::post('delete-gallery-item', [GalleryController::class, 'destroy'])->name('deleteGalleryItem');


        Route::resource('create-module-body', ModulesMakerController::class)->names([
            'index' => 'moduleBody',
            'store' => 'moduleBody.create',
            'show' => 'moduleBody.show',
        ]);
        Route::resource('module-data', ModuleDataController::class)->names([
            'show' => 'moduleData.show',
            'destroy' => 'moduleDelete'
        ]);
        Route::get('module-edit/{id}', [ModuleEditController::class, 'editData'])->name('module-edit');
        Route::post('module-update/{id}', [ModuleEditController::class, 'updateData'])->name('module-update');
        Route::get('module-data-delete/{id}', [ModuleEditController::class, 'deleteData'])->name('module-delete');

        Route::get('randevu/pdf/{id}', [PdfMakerController::class, 'PdfMaker'])->name('pdfmaker');
        Route::resource('randevu', RandevuController::class);
        Route::post('randevu/search', [RandevuController::class, 'search'])->name('randevusearch');


        Route::resource('galeri-kategori',GalleryCategoryController::class);
        Route::resource('galeri',GalleryController::class);


        Route::resource('urunler',ProductsController::class);
        Route::resource('urun-kategorileri',ProductsCategoryController::class);
        Route::resource('varyantlar',ProductsVariantController::class);

    });
