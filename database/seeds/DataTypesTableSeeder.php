<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => __('Product'),
                'display_name_plural'   => __('Products'),
                'icon'                  => 'voyager-bag',
                'model_name'            => 'App\\Product',
                'controller'            => '\\App\\Http\\Controllers\\Voyager\\ProductsController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'categories',
                'display_name_singular' => __('Category'),
                'display_name_plural'   => __('Categories'),
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\\Category',
                'controller'            => '\\App\\Http\\Controllers\\Voyager\\CategoriesController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'currencies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'currencies',
                'display_name_singular' => __('Currency'),
                'display_name_plural'   => __('Currencies'),
                'icon'                  => 'voyager-dollar',
                'model_name'            => 'App\\Currency',
                'controller'            => '\\App\Http\\Controllers\\Voyager\\CurrenciesController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'product-statuses');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'product_statuses',
                'display_name_singular' => __('Product Status'),
                'display_name_plural'   => __('Product Statuses'),
                'icon'                  => '',
                'model_name'            => 'App\\ProductStatus',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'product-labels');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'product-labels',
                'display_name_singular' => __('Product Label'),
                'display_name_plural'   => __('Product Labels'),
                'icon'                  => '',
                'model_name'            => 'App\\ProductLabel',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        
        $dataType = $this->dataType('slug', 'subcategories');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'subcategories',
                'display_name_singular' => __('Subcategory'),
                'display_name_plural'   => __('Subcategories'),
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\\Subcategory',
                'controller'            => '\\App\\Http\\Controllers\\Voyager\\SubcategoriesController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'banner');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'banner',
                'display_name_singular' => __('Banner'),
                'display_name_plural'   => __('Banners'),
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\\Models\\Banner',
                'controller'            => '\\App\\Http\\Controllers\\Voyager\\AdminBannerController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'attribute');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'attribute',
                'display_name_singular' => __('Attribute'),
                'display_name_plural'   => __('Attributes'),
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\\Models\\Attribute',
                'controller'            => '\\App\\Http\\Controllers\\Voyager\\AttributeController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'colors');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'colors',
                'display_name_singular' => __('Color'),
                'display_name_plural'   => __('Colors'),
                'icon'                  => '',
                'model_name'            => 'App\\Color',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
