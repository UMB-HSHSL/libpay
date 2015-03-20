# Authorizer

Authorization handlers. The following method is provided:

`is_authorized($username)` return boolean TRUE if user is authorized, boolean FALSE otherwise.

## Config

```php
// config file
$config['authorizer'] = 'Array_authorizer';

// controller file
$this->load->add_package_path(APPPATH.'third_party/authorizer/');
$this->load->library(config_item('authorizer'), array(), 'authorizer');
$this->load->remove_package_path();
if (! $this->authorizer->is_authorized('some-username-presumably-not-actually-hardcoded')) {
    show_error('Sorry; you are not authorized to view this page.');
}

```

## Implementations

### Deny

Deny all requests.

### Array

Lookup username in a list of accepted users.

```php
$config['authorized_users'] = array('foo', 'bar', 'bat');

````

### Passthrough

Accept all requests.
