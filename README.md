# Authenticator

Authentication handlers. The following methods are provided:

`authenticate($username, $password)` authenticates a user or throws an `Authentication_exception`

`is_authenticated()` returns boolean TRUE if a user is currently authenticated, FALSE otherwise

`username()` returns the username if a user is currently authenticated; throws an `Authentication_exception` otherwise

`name()` returns a user's name if a user is currently authenticated; throws an `Authentication_exception` otherwise

## Config

```php
// config file
$config['authenticator'] = 'Ldap_authenticator';

// controller file
$this->load->add_package_path(APPPATH.'third_party/authenticator/');
$this->load->library(config_item('authenticator'), array(), 'authenticator');
$this->load->remove_package_path();
if (! $this->authenticator->is_authenticated()) {
    redirect("login");
    return;
}

```

## Implementations

### Deny

Deny all requests.

### Ldap

Lookup username and password in an LDAP directory. Sample config:

```php
// name of the LDAP server
$config['ldap_host']    = 'ldap.server.edu';

// path in the tree where we should look for users
$config['ldap_base_dn'] = 'OU=Some Unit,DC=ldap,DC=server,DC=edu';

// field to match the username against; {USERNAME} will be replaced by the given username
$config['ldap_filter']  = '(samaccountname={USERNAME})';

// fields to use to retrieve the user's name
$config['ldap_fields']  = array('cn');
````

### Passthrough

Accept all requests, returning the username "username" and the name "Dummy User".
