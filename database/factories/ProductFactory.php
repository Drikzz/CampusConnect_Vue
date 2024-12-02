<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        static $imageIndex = 1;

        $price = $this->faker->numberBetween(100, 10000); // Price in cents
        $discount = $this->faker->numberBetween(0, 100); // Discount percentage

        // Calculate discounted price
        $discountedPrice = $price - ($price * ($discount / 100));

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $price,
            'discount' => $discount,
            'discounted_price' => $discountedPrice,
            'image' => 'imgs/img' . $imageIndex++ . '.jpg',
            'stock' => $this->faker->numberBetween(1, 100),
            'user_id' => 1,
            'is_buyable' => $this->faker->numberBetween(0, 1),
            'is_tradable' => $this->faker->numberBetween(0, 1),
        ];
    }
}
