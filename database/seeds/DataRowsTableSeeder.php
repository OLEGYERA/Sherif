<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $userDataType = DataType::where('slug', 'users')->firstOrFail();
        $menuDataType = DataType::where('slug', 'menus')->firstOrFail();
        $roleDataType = DataType::where('slug', 'roles')->firstOrFail();
        $productsDataType = DataType::where('slug', 'products')->firstOrFail();
        $categoriesDataType = DataType::where('slug', 'categories')->firstOrFail();
        $currenciesDataType = DataType::where('slug', 'currencies')->firstOrFail();
        $productStatusesDataType = DataType::where('slug', 'product-statuses')->firstOrFail();
        $productLabelsDataType = DataType::where('slug', 'product-labels')->firstOrFail();
        $productSubcategoriesDataType = DataType::where('slug', 'subcategories')->firstOrFail();
        $attributeDataType = DataType::where('slug','attribute')->firstOrFail();
        $colorDataType = DataType::where('slug','colors')->firstOrFail();
        $interestDataType = DataType::where('slug','interests')->firstOrFail();

        $dataRow = $this->dataRow($userDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.email'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => __('voyager::seeders.data_rows.password'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'remember_token');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.remember_token'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'avatar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => __('voyager::seeders.data_rows.avatar'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'user_belongsto_role_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('voyager::seeders.data_rows.role'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{"model":"TCG\\\Voyager\\\Models\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"display_name","pivot_table":"roles","pivot":"0"}',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'user_belongstomany_role_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Roles',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{"model":"TCG\\\Voyager\\\Models\\\Role","table":"roles","type":"belongsToMany","column":"id","key":"id","label":"display_name","pivot_table":"user_roles","pivot":"1","taggable":"0"}',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'locale');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Locale',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'settings');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Settings',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'display_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.display_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'role_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.role'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        /* Products */
        $dataRow = $this->dataRow($productsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productsDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{"slugify":{"origin":"name","forceUpdate":true}}',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'vendor_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Vendor Code'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'category');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Category'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'EUR');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('EUR'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'USD');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('USD'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'UAH');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('UAH'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'profitability');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Рентабельность'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'color');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'color',
                'display_name' => __('Цвет'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'manufacturer');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Производитель'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'URL');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('URL'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => __('Description'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 15,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'publication');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => __('Публикация'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{"on":"Yes","off":"No"}',
                'order'        => 16,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'characteristics');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => __('Characteristics'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 17,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'price_final');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Final Price'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 18,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_hasone_currency_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Currencies'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"model":"App\\\Currency","table":"currencies","type":"belongsTo","column":"currency_final","key":"id","label":"name","pivot_table":"Categories","pivot":"0","taggable":"0"}',
                'order'        => 19,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'currency_final');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Учётная валюта'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 19,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_belongstomany_subcategory_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Подкатегория'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"model":"App\\\Subcategory","table":"subcategories","type":"belongsToMany","column":"category","key":"id","label":"name","pivot_table":"product_subcategories_pivot","pivot":"1","taggable":"on"}',
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Категория'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_belongsto_product_status_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Статус'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"model":"App\\\ProductStatus","table":"product_statuses","type":"belongsTo","column":"status","key":"id","label":"name","pivot_table":"Categories","pivot":"0","taggable":"0"}',
                'order'        => 21,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_belongsto_product_label_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Метка'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"model":"App\\\ProductLabel","table":"product_labels","type":"belongsTo","column":"label","key":"id","label":"name","pivot_table":"Categories","pivot":"0","taggable":"0"}',
                'order'        => 22,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'label');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Метка'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 21,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Код товара'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 22,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'sale_discount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Скидка (%)'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 34,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'sale_price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Стоимость со скидкой'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 35,
                ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'mainimage');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => __('voyager::seeders.data_rows.mainimage'),
                'required' => 0,
                'browse' => 1,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"resize":{"width":"1000","height":"null"},"quality":"75%","upsize":true,"thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}',
                'order' => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_belongstomany_attribute_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Атрибуты'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Models\\\\Attribute","table":"attribute","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"product_attributes_pivot","pivot":"1","taggable":"0"}',
                'order' => 28,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'addimage');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'multiple_images',
                'display_name' => __('Изображения'),
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => NULL,
                'order' => 24,
            ])->save();
        }

        $dataRow = $this->dataRow($productsDataType, 'concomitant');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Сопутствующий'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App/Product"}',
                'order' => 30,
            ])->save();
        }

        $dataRow = $this->dataRow($productsDataType, 'similar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Похожий'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App/Product"}',
                'order' => 31,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_hasone_subcategory_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Главная категория'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Subcategory","table":"subcategories","type":"belongsTo","column":"maincategory","key":"id","label":"name","pivot_table":"Currencies","pivot":"0","taggable":"0"}',
                'order' => 33,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'maincategory');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Maincategory'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => NULL,
                'order' => 32,
            ])->save();
        }
        $dataRow = $this->dataRow($productsDataType, 'product_belongsto_color_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('Цвет'),
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => {"model":"App\\\Color","table":"colors","type":"belongsTo","column":"color","key":"id","label":"name","pivot_table":"attribute","pivot":"0","taggable":"0"},
                'order' => 36,
            ])->save();
        }

        /* Categories */
        $dataRow = $this->dataRow($categoriesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($categoriesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($categoriesDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{"slugify":{"origin":"name","forceUpdate":true}}',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($categoriesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($categoriesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($categoriesDataType, 'sale_discount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Скидка (%)'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }
        

        /* Currencies */
        $dataRow = $this->dataRow($currenciesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('ID'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($currenciesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($currenciesDataType, 'rate');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Rate'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($currenciesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($currenciesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        /* Product Statuses  */
        $dataRow = $this->dataRow($productStatusesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('ID'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($productStatusesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($productStatusesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($productStatusesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        /* Subcategories */
        $dataRow = $this->dataRow($productLabelsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('ID'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($productLabelsDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($productLabelsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($productLabelsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        /* Product Labels */
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('ID'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'subcategory_belongsto_category_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('categories'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"model":"App\\\Category","table":"categories","type":"belongsTo","column":"category","key":"id","label":"name","pivot_table":"Currencies","pivot":"0","taggable":"0"}',
                'order'        => 7,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'category');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Category'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Slug'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"slugify":{"origin":"name","forceUpdate":true}}',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($productSubcategoriesDataType, 'sale_discount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('Скидка (%)'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
                ])->save();
        }
        $dataRow = $this->dataRow($attributeDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('id'),
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => NULL,
                'order' => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($attributeDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Имя'),
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => NULL,
                'order' => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($attributeDataType, 'value');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Значение'),
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => NULL,
                'order' => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($attributeDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('Created At'),
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => NULL,
                'order' => 4,
            ])->save();
        }
        $dataRow = $this->dataRow($attributeDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('Updated at'),
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => NULL,
                'order' => 5,
            ])->save();
        }

        $colorDataType = $this->dataRow($attributeDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('Updated at'),
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => NULL,
                'order' => 5,
            ])->save();
        }
        
        /* Colors */
        $dataRow = $this->dataRow($colorDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('ID'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($colorDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Name'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($colorDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }
        $dataRow = $this->dataRow($colorDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

         /* Interests */
         $dataRow = $this->dataRow($interestDataType, 'id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('ID'),
                 'required'     => 1,
                 'browse'       => 0,
                 'read'         => 1,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 1,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'product_id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('ID товара'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 2,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'phone_number');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('Номер телефона'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 3,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'name');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('ФИО'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 4,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'email');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('Почта'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 5,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'social_media');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('Социальная сеть'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 6,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'product_URL');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('URL товара'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 7,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'created_at');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'timestamp',
                 'display_name' => __('voyager::seeders.data_rows.created_at'),
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 8,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'updated_at');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'timestamp',
                 'display_name' => __('voyager::seeders.data_rows.updated_at'),
                 'required'     => 0,
                 'browse'       => 0,
                 'read'         => 1,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 9,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'vendor_code');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('Артикул'),
                 'required'     => 0,
                 'browse'       => 0,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 10,
             ])->save();
         }
         $dataRow = $this->dataRow($interestDataType, 'code');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => __('Код товара'),
                 'required'     => 0,
                 'browse'       => 0,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => '',
                 'order'        => 11,
             ])->save();
         }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }
}
