<!-- Copy of readme.md -->

<h1>Small MVC</h1>

<p class="lead">A lightweight MVC framework with layout variations and reusable components</p>

<h3>Directory Structure</h3>
<hr>


<p>Small MVC uses a straightforward and logical folder structure. Here is a quick overview of where to place your files:</p>

<pre>
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
</pre>

<h3>Usage</h3>
<hr>

<h4>Rendering Views</h4>
<p>To render a view, use the <code>renderView</code> method. You can optionally pass data to the view and specify a custom layout.</p>

<b>Method Signature:</b>
<br>
<code><pre>
renderView(string $view, array $data = [], string $layout = 'app')
</pre></code>

<b>Rendering the homepage and passing a title variable to the view:</b><br>
<code><pre>
$this->renderView('home/index', [
    'pageTitle' => 'Homepage'
]);
</pre></code>

<h4>Redirects & Flash Messages</h4>

<p>The base controller provides a convenient <code>redirect</code> method that handles safe HTTP redirects and optionally sets a flash message in a single call.</p>

<b>Setting a redirect with a message (Controller):</b><br>
<code><pre>
$this->redirect('/profile', [
    'type' => 'success',
    'message' => 'Your profile was updated successfully!'
]);
</pre></code>   

<b>Displaying the message (View/Layout):</b><br>
<p>Place the flash component in your main layout to automatically render the Bootstrap alert.</p>
<code>
component('flash');
</code>

<h4>UI Components</h4>

<p>To keep your views clean and DRY (Don't Repeat Yourself), Small MVC supports reusable UI components. The `component` function includes a template from the `app/components/` directory and makes the provided data available within that file.</p>

<b>Function Signature:</b><br>
<code><pre>
/**
 * @param string $name The name of the component file (without .view.php)
 * @param array  $data Variables to pass into the component
 */
component(string $name, array $data = [])
</pre></code>


<b>Example Usage:</b><br>

<b>1. Create the component:</b><br> 
<p>Save your reusable HTML/PHP code in the components folder. For example, <code>app/components/button.view.php</code>:</p>
<code><pre>&lt;button class="&lt;?= $class ?? 'btn-default' ?&gt;"&gt;&lt;?php $text ?&gt;&lt;/button&gt;
</pre></code>

<b>2. Render the component in a view:</b><br>
<p>Call the `component` function inside any layout or view to render it, passing the required data as an associative array:</p>
<code><pre>
    component('button', [
        'text' => 'Submit Form',
        'class' => 'btn-primary'
    ]); 
</pre></code>

<h4>JSON Responses (API)</h4>

<p>Small MVC is not just for rendering HTML views. If you are building an API or handling AJAX/Fetch requests, the base controller includes a convenient `json` method. It automatically sets the correct `Content-Type` headers, applies the HTTP status code, and encodes your array.</p>

<b>Method Signature:</b><br>
<code><pre>
/**
 * @param array $data   The data to be encoded to JSON
 * @param int   $status The HTTP status code (default: 200)
 */
json(array $data, int $status = 200): void
</pre></code>

<b>Example Usage:</b><br>
<code><pre>
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
</pre></code>

<h4>View Helpers</h4>

<p>To make your HTML templates cleaner, Small MVC provides convenient helper functions.</p>

<b>Active Navigation Links:</b>
<p>The `isActive` function is perfect for dynamically highlighting the current page in your navigation menus. It compares the current page title (or route) with a reference string and returns the string `'active'` if they match.</p>

<b>Example Usage:</b><br>
<code><pre>
&lt;nav class="nav"&gt;
    &lt;a class="nav-link &lt;?= isActive($pageTitle, 'Översikt') ?&gt;" href="/"&gt;
        Översikt
    &lt;/a&gt;
    &lt;a class="nav-link &lt;?= isActive($pageTitle, 'Konto') ?&gt;" href="/account"&gt;
        Mitt Konto
    &lt;/a&gt;
&lt;/nav&gt;
</pre></code>

<h4>Localization & Encoding</h4>

<p>Small MVC is pre-configured for a localized environment right out of the box. The Base Controller automatically sets up the correct timezone, locale, and character encoding in its constructor. </p>

<p>By default, every controller extending the base class inherits the following configuration:</p>
<pre>
- **Timezone:** `Europe/Stockholm`
- **Locale:** `sv_SE.UTF-8` (Ensures correct Swedish date and time formatting)
- **Encoding:** `UTF-8` (Safely handles multi-byte characters like Å, Ä, Ö)</pre>

<b>Under the hood:</b>
<code><pre>
// app/core/BaseController.php
public function __construct() {   
    date_default_timezone_set('Europe/Stockholm');
    setlocale(LC_TIME, 'sv_SE.UTF-8');
    mb_internal_encoding("UTF-8");
}
</pre></code>
<i>Note: If you are building an app for a different region, simply adjust these values in the Base Controller.</i>