<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->numberBetween(100, 10000);
        $discount = $this->faker->numberBetween(0, 100);
        $discountedPrice = $price - ($price * ($discount / 100));

        // Get 5 random unique image indices from 1-8
        $selectedIndices = collect(range(1, 8))
            ->shuffle()
            ->take(5)
            ->values()
            ->all();

        // Generate image URLs for the selected indices
        $imageUrls = array_map(function ($index) {
            return asset("imgs/img{$index}.jpg");
        }, $selectedIndices);

        // Generate random values for is_buyable and is_tradable
        $rand = $this->faker->numberBetween(1, 100);
        if ($rand <= 80) {
            $is_buyable = $this->faker->boolean();
            $is_tradable = $is_buyable ? $this->faker->boolean() : true;
        } else {
            $is_buyable = true;
            $is_tradable = true;
        }

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $price,
            'discount' => $discount,
            'discounted_price' => $discountedPrice,
            'images' => $imageUrls,
            'stock' => $this->faker->numberBetween(1, 100),
            'seller_code' => function () {
                // Get an existing seller's code
                return User::where('is_seller', true)->first()->seller_code;
            },
            'category_id' => 1,
            'trade_method_id' => 1,
            'is_buyable' => $is_buyable,
            'is_tradable' => $is_tradable,
        ];
    }
}
