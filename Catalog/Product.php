<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 17.04.2018
 * Time: 22:13
 */

abstract class Product
{

    public static function GetSelection()
    {
        self::render_select([]);
    }

    private static function render_select($product_types)
    {
        ?>
        <div class="form-group">
            <label for="product_type">Product type:</label>
            <select class="form-control" id="product_type" name="product_type">
                <option value="all">Все</option>
                <?php
                foreach ($product_types as $type => $product_type_value) {
                    if (!empty($_GET['product_type']) && ($_GET['product_type']) == $product_type_value) {
                        echo "<option selected>$product_type_value</option>";
                    } else {
                        echo "<option>$product_type_value</option>";
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }
}