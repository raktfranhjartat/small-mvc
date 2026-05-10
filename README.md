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

## Zero-Configuration Routing

Small MVC uses a dynamic, convention-based routing system. You **do not** need to define your routes manually in a file. The router automatically maps the URL to the correct Controller, Method, and Parameters.

### URL Structure
The router breaks down the URL into the following pattern:
`http://yoursite.com/{controller}/{action}/{param1}/{param2}`

*   **Controller:** The first segment (defaults to `HomeController`).
*   **Action:** The second segment (defaults to `index`).
*   **Parameters:** Any remaining segments are passed as arguments to the method.

### Routing Examples

| URL Path | Maps to Controller & Method | Passed Parameters |
| :--- | :--- | :--- |
| `/` | `HomeController->index()` | *(none)* |
| `/users` | `UsersController->index()` | *(none)* |
| `/users/profile` | `UsersController->profile()` | *(none)* |
| `/products/show/42` | `ProductsController->show($id)` | `$id = 42` |
| `/blog/edit/12/draft` | `BlogController->edit($id, $status)`| `$id = 12`, `$status = 'draft'` |

### Kebab-Case URLs
The router automatically converts URL-friendly kebab-case into properly formatted class names (StudlyCaps). For example, visiting `/user-settings/update` will automatically resolve to `UserSettingsController->update()`.

### Smart Parameter Handling & 404s
Using PHP Reflection, the router checks how many parameters your controller method expects. If a user visits a URL without providing all parameters, the missing ones are safely set to `null` to prevent crashes.

If a controller, method, or file does not exist, the router automatically catches it and triggers the `ErrorController->notFound()` method.

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
 * @param string $name The name of the component file (without .component.php)
 * @param array  $data Variables to pass into the component
 */
component(string $name, array $data = [])
```

**Example Usage:**

**1. Create the component:** 
Save your reusable HTML/PHP code in the components folder. For example, `app/components/button.component.php`:
```php
<!-- app/components/button.component.php -->
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

## Models & Database

Small MVC includes a powerful, custom PDO wrapper that makes database interactions incredibly clean and secure. All queries automatically use prepared statements to protect against SQL injection.

### Configuration
Database credentials should be defined as constants in your `config.php` file. The framework supports multiple databases by dynamically loading constants based on a key (e.g., `DB_APP`).

```php
// config/config.php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'secret');
define('DB_APP', 'test_db');
```

### Creating Models
Models should extend the `BaseModel` class, which automatically initializes the database connection under `$this->db`. The Database class provides convenient helper methods for CRUD operations.

```php
// app/models/UserModel.php

class UserModel extends BaseModel
{
    /**
     * Fetch a single user by ID
     */
    public function getUser(int $id): array|false
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    /**
     * Fetch all active users
     */
    public function getActiveUsers(): array
    {
        $sql = "SELECT * FROM users WHERE status = :status";
        return $this->db->fetchAll($sql, ['status' => 'active']);
    }

    /**
     * Create a new user and return the inserted ID
     */
    public function createUser(string $name, string $email): int|false
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        return $this->db->insert($sql, [
            'name' => $name,
            'email' => $email
        ]);
    }
}
```

### Supported Database Methods
The core `$this->db` object provides the following helpful wrappers:
*   `query($sql, $params)` - Executes a raw query and returns the PDOStatement.
*   `fetch($sql, $params)` - Returns a single row as an associative array.
*   `fetchAll($sql, $params)` - Returns an array of all matching rows.
*   `insert($sql, $params)` - Executes an INSERT statement and returns the `lastInsertId`.
*   `update($sql, $params)` - Executes an UPDATE statement and returns the number of affected rows.
*   `delete($sql, $params)` - Executes a DELETE statement and returns the number of affected rows.