# Small MVC

> A lightweight MVC framework with layout variations and reusable components

## Directory Structure

Small MVC uses a straightforward and logical folder structure. Here is a quick overview of where to place your files:

```text
small-mvc/
├───app
│   ├───components  # Reusable UI components    
│   ├───controllers # Application controllers handling logic  
│   ├───core        # Core framework files (routing, base classes)
│   ├───models      # Database models and data logic
│   └───views       # HTML templates and views go here
│       ├───home    # Views for the Home controller (e.g., index.php)
│       └───layout  # Layout wrappers (e.g., app.php)
├───config          # Configuration files (database, settings, etc.)
└───public          # Document root, contains index.php and public assets
```

## Usage

### Rendering Views
To render a view, use the ``renderView` method. You can optionally pass data to the view and specify a custom layout

**Method Signature:**
```php
renderView(string $view, array $data = [], string $layout = 'app')
```

**Rendering the homepage and passing a title variable to the view:**
```php
$this->renderView('home/index', [
    'pageTitle' => 'Homepage'
]);
```

### Redirects & Flash Messages

The base controller provides a convenient `redirect` method that handles safe HTTP redirects and optionally sets a flash message in a single call.

**Setting a redirect with a message (Controller):**
```php
// Redirects to /profile and sets a success message
$this->redirect('/profile', [
    'type' => 'success',
    'message' => 'Your profile was updated successfully!'
]);
```

**Displaying the message (View/Layout):**
Place the flash component in your main layout to automatically render the Bootstrap alert.
```php
<?php component('flash'); ?>
```

### UI Components

To keep your views clean and DRY (Don't Repeat Yourself), Small MVC supports reusable UI components. The `component` function includes a template from the `app/components/` directory and makes the provided data available within that file.

**Function Signature:**
```php
/**
 * @param string $name The name of the component file (without .view.php)
 * @param array  $data Variables to pass into the component
 */
component(string $name, array $data = [])
```

**Example Usage:**

**1. Create the component:** 
Save your reusable HTML/PHP code in the components folder. For example, `app/components/button.view.php`:
```php
<!-- app/components/button.view.php -->
<button class="<?= $class ?? 'btn-default' ?>">
    <?= $text ?>
</button>
```

**2. Render the component in a view:**
Call the `component` function inside any layout or view to render it, passing the required data as an associative array:
```php
<?php 
    component('button', [
        'text' => 'Submit Form',
        'class' => 'btn-primary'
    ]); 
?>
```

### JSON Responses (API)

Small MVC is not just for rendering HTML views. If you are building an API or handling AJAX/Fetch requests, the base controller includes a convenient `json` method. It automatically sets the correct `Content-Type` headers, applies the HTTP status code, and encodes your array.

**Method Signature:**
```php
/**
 * @param array $data   The data to be encoded to JSON
 * @param int   $status The HTTP status code (default: 200)
 */
json(array $data, int $status = 200): void
```

**Example Usage:**
```php
// Inside a controller handling an API endpoint
public function getUser(int $id)
{
    // Pretend we fetch a user from the database
    $user = ['id' => $id, 'name' => 'John Doe'];

    if (!$user) {
        // Return a 404 Not Found response
        $this->json(['error' => 'User not found'], 404);
    }

    // Return a 200 OK response with the user data
    $this->json(['status' => 'success', 'data' => $user]);
}
```

### View Helpers

To make your HTML templates cleaner, Small MVC provides convenient helper functions.

**Active Navigation Links:**
The `isActive` function is perfect for dynamically highlighting the current page in your navigation menus. It compares the current page title (or route) with a reference string and returns the string `'active'` if they match.

**Example Usage:**
```php
<nav class="nav">
    <a class="nav-link <?= isActive($pageTitle, 'Översikt') ?>" href="/">
        Översikt
    </a>
    <a class="nav-link <?= isActive($pageTitle, 'Konto') ?>" href="/account">
        Mitt Konto
    </a>
</nav>
```

### Localization & Encoding

Small MVC is pre-configured for a localized environment right out of the box. The Base Controller automatically sets up the correct timezone, locale, and character encoding in its constructor. 

By default, every controller extending the base class inherits the following configuration:
- **Timezone:** `Europe/Stockholm`
- **Locale:** `sv_SE.UTF-8` (Ensures correct Swedish date and time formatting)
- **Encoding:** `UTF-8` (Safely handles multi-byte characters like Å, Ä, Ö)

**Under the hood:**
```php
// app/core/BaseController.php
public function __construct() {   
    date_default_timezone_set('Europe/Stockholm');
    setlocale(LC_TIME, 'sv_SE.UTF-8');
    mb_internal_encoding("UTF-8");
}
```
*Note: If you are building an app for a different region, simply adjust these values in the Base Controller.*