<?php

namespace App\Http\Services;

use Stripe\Collection;
use Stripe\StripeClient;
use Stripe\Product;

class StripeService
{
       public StripeClient $stripeClient;

       /**
        * __construct
        *
        * @return void
        */
       public function __construct()
       {
              $this->stripeClient =  new StripeClient(env('STRIPE_SECRET'));
       }

       /**
        * getProducts
        *
        * @param  int $limit
        * @return Collection<Product>
        */
       public function getProducts(int $limit): Collection
       {
              return $this->stripeClient->products->all(['limit' => $limit]);
       }

       /**
        * storeProduct
        *
        * @param  array<string,mixed> $data
        * @return Product
        */
       public function storeProduct(array $data): Product
       {
              return $this->stripeClient->products->create($data);
       }
}
