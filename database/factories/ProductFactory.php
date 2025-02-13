<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $discount = $this->faker->boolean(30) ? $this->faker->numberBetween(5, 50) : 0;
        $discountedPrice = $price - ($price * ($discount / 100));

        // Generate 1-3 random image URLs
        $imageCount = $this->faker->numberBetween(1, 3);
        $imageUrls = [];
        for ($i = 0; $i < $imageCount; $i++) {
            $selectedIndex = $this->faker->numberBetween(1, 8);
            $imageUrls[] = "products/sample_imgs/img{$selectedIndex}.jpg";
        }

        // Fix: Generate product condition using exact enum values
        $condition = $this->faker->randomElement(['New', 'Like New', 'Good', 'Fair']);

        // Determine if product is buyable and/or tradable
        $is_buyable = $this->faker->boolean(80);
        $is_tradable = $is_buyable ? $this->faker->boolean(40) : true;

        // Generate trade preferences if tradable
        $trade_preferences = $is_tradable ? [
            'categories' => $this->faker->randomElements([1, 2, 3, 4, 5], $this->faker->numberBetween(1, 3)),
            'condition_minimum' => $this->faker->randomElement(['Any', 'Good', 'Like New']),
            'price_range' => [
                'min' => $price * 0.8,
                'max' => $price * 1.2,
            ],
        ] : null;

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(2, true),
            'price' => $price,
            'discount' => $discount,
            'discounted_price' => $discountedPrice,
            'images' => $imageUrls,
            'stock' => $this->faker->numberBetween(1, 20),
            'category_id' => $this->faker->numberBetween(1, 5), // Match actual number of categories
            'is_buyable' => $is_buyable,
            'is_tradable' => $is_tradable,
            'condition' => $condition,
            'trade_preferences' => $trade_preferences,
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Sold']), // Match exact enum values
        ];
    }
}
