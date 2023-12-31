# Whoami

### Method

```php
$api->whoami
```

## Parameters

None

## Response

```php
array [
    "type" => string,
    "id" => string,
    "name" => string, # username
    "fullname" => string, # display name
    "email" => string,
    "emailVerified" => bool,
    "canPay" => bool,
    "isPro" => bool,
    "periodEnd" => int,
    "avatarUrl" => string,
    "orgs" => array [
        array [
            "type" => string "org",
            "id" => string,
            "name" => string, # username
            "fullname" => string, # display name
            "email" => string,
            "emailVerified" => bool,
            "canPay" => bool,
            "isPro" => bool,
            "periodEnd" => int,
            "avatarUrl" => string,
            "roleInOrg" => string,
            "isEnterprise" => bool
        ]
    ]
]
```

## Example

Print your email address:

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
echo $api->whoami()['email'];
```