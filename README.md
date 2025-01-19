# Bigcommerce API Service

The **`Bigcommerce API Service`** package allows you to interact with Bigcommerce's API for managing catalog resources such as products, categories, brands, variants, custom fields, and more.

---

## Installation

Install the package via Composer:

```bash
composer require yvz/bigcommerce-api-service
```

Add necessary configurations to your `.env` file:

```env
BIGCOMMERCE_BASE_URL=https://api.bigcommerce.com/stores
BIGCOMMERCE_STORE_HASH=YOUR_STORE_HASH
BIGCOMMERCE_ACCESS_TOKEN=YOUR_ACCESS_TOKEN
```

---

## Usage

You can dynamically access all the available resources through the `BigcommerceApiService` class. Example:

```php
use Yvz\BigcommerceApiService\Services\BigcommerceApiService;

$service = new BigcommerceApiService('storeHash', 'accessToken');

// Example: Fetch product list
$products = $service->products->list(['limit' => 10]);
```

---

## Available Resources and Methods

The following resources are available, each with its corresponding methods for interacting with the Bigcommerce API.

---

### **1. CategoryResource**

#### Methods:
- **`list(array $parameters, bool $includeHeaders = true): array`**  
  Retrieves a list of categories.
    - **Example:**
      ```php
      $categories = $service->categories->list(['limit' => 10]);
      ```

- **`show(int $id, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific category.
    - **Example:**
      ```php
      $category = $service->categories->show(123);
      ```

---

### **2. BrandResource**

#### Methods:
- **`list(array $parameters, bool $includeHeaders = true): array`**  
  Retrieves a list of brands.
    - **Example:**
      ```php
      $brands = $service->brands->list(['limit' => 5]);
      ```

- **`show(int $brandId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific brand.
    - **Example:**
      ```php
      $brand = $service->brands->show(45);
      ```

---

### **3. ProductResource**

#### Methods:
- **`list(array $parameters, bool $includeHeaders = true): array`**  
  Retrieves a list of products.
    - **Example:**
      ```php
      $products = $service->products->list(['limit' => 20]);
      ```

- **`show(int $id, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific product.
    - **Example:**
      ```php
      $product = $service->products->show(567);
      ```

---

### **4. ProductVariantResource**

#### Methods:
- **`list(int $productId, array $parameters, bool $includeHeaders = true): array`**  
  Retrieves a list of variants for a given product.
    - **Example:**
      ```php
      $variants = $service->variants->list(1234, []);
      ```

- **`batchList(array $parameters, bool $includeHeaders = true): array`**  
  Retrieves a batch list of variants.
    - **Example:**
      ```php
      $batchVariants = $service->variants->batchList([]);
      ```

- **`show(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific variant.
    - **Example:**
      ```php
      $variant = $service->variants->show(1234, 5678);
      ```

---

### **5. ProductModifierResource**

#### Methods:
- **`list(int $productId, array $parameters, bool $includeHeaders = true): array`**  
  Retrieves the list of modifiers for a product.
    - **Example:**
      ```php
      $modifiers = $service->modifiers->list(1234, []);
      ```

- **`show(int $productId, int $modifierId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific modifier.
    - **Example:**
      ```php
      $modifier = $service->modifiers->show(1234, 4321);
      ```

---

### **6. ProductCustomFieldResource**

#### Methods:
- **`list(int $productId, array $parameters, bool $includeHeaders = true): array`**  
  Retrieves the list of custom fields for a product.
    - **Example:**
      ```php
      $customFields = $service->customFields->list(1234, []);
      ```

- **`show(int $productId, int $customFieldId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific custom field.
    - **Example:**
      ```php
      $customField = $service->customFields->show(1234, 5678);
      ```

---

### **7. ProductMetafieldResource**

#### Methods:
- **`list(int $productId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves all metafields for a product.
- **`batchList(array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves a batch list of metafields.
- **`create(int $productId, array $parameters = [], bool $includeHeaders = true): array`**  
  Creates a metafield for a product.
- **`update(int $productId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array`**  
  Updates a metafield for a product.
- **`delete(int $productId, int $metafieldId, bool $includeHeaders = true): array`**  
  Deletes a metafield for a product.

---

### **8. ProductVariantMetafieldResource**

#### Methods:
- **`list(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves all metafields for a product variant.
    - **Example:**
      ```php
      $metafields = $service->variantMetafields->list(1234, 5678, []);
      ```

- **`batchList(array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves a batch list of metafields.
- **`show(int $productId, int $variantId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array`**  
  Retrieves details of a specific metafield.
- **`create(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array`**  
  Creates a new metafield for a variant.
- **`update(int $productId, int $variantId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array`**  
  Updates an existing metafield for a variant.
- **`delete(int $productId, int $variantId, int $metafieldId, bool $includeHeaders = true): array`**  
  Deletes a metafield for a variant.

---

## Response Format

All requests return a structured data array:

### Success:
```php
[
    'status' => true,        // true if request was successful
    'statusCode' => 200,     // HTTP response code
    'data' => [...],         // Response data
    'headers' => [...]       // Headers in the response
]
```

### Error:
```php
[
    'status' => false,       
    'statusCode' => 400,     
    'error_bag' => 'Error message...', 
    'headers' => [...]
]
```
