# Initialization

To get started, first make sure you've imported the `hub.php` library:

```php
include 'hub.php';
```

Then, initialize a new HF Hub API object:

```php
$api = new Hub('<your_hf_token>');
```

!!! note
    Don't have a Hugging Face token yet? Get one [here](https://huggingface.co/settings/tokens)! All you need is a free Hugging Face account. Make sure the token's role is set to `write` for all methods to work!
    
    * Make sure your token begins with `hf_`!
    * **Make sure not to share your token** or publish code with your token. Check your code before open-sourcing it to ensure it doesn't have any tokens.