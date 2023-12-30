**Important:** This package currently does not support LFS files

# HFHubPHP Alpha

*A portable (in both senses, easily installable and easy to port), fast, and simple wrapper for the Hugging Face Hub APIs, similar to the HF Hub Python library.*

A PHP library for interacting with the Hugging Face Hub. Everything is done in a single file, so all you have to do is drag the file in and import it with `include`!

**This library is designed to be *portable*, *simple*, and *easily portable* to another language.** If you're interested in porting this library to another language, please see the Porting section below!

## Todo

We aim to support the following methods, with similar APIs as the original `huggingface_hub` Python library:

- [ ] Inference APIs
- [x] User
  - [x] Whoami
- [x] Repo Operations
    - [x] Full HF Spaces support
  - [x] Create
  - [x] Delete
  - [x] Move
  - [x] Update Visibility
  - [x] Files
    - [x] Create
    - [x] Download
    - [x] Delete
    - [x] List
  - [x] Folder
    - [x] Delete
  - [ ] Later: Add LFS support

## Documentation

### Installation

Just drag'n'drop the classes you need into your project folder! `hub.php` includes everything you need to interact with the HF Hub!

### Usage

More documentation coming soon!

```php
include 'hub.php';
$api = new Hub('hf_***');
```

### Methods

> NOTE: Starting with PHP 8, you can now use named arguments! This means you can call `$api->create_repo` as `$api->create_repo('username/model', private: True)`!

```php
# API
$api = new Hub($token)
# Repo operations
$api->create_repo($repo_id, $repo_type = 'model', $private = False, $space_sdk = null, $space_hardware = null, $space_storage = null, $space_sleep_time = null, $space_secrets = null, $space_variables = null)
$api->delete_repo($repo_id, $repo_type = 'model')
$api->move_repo($from_id, $to_id, $repo_type = 'model')
# File operations
$api->upload_string($repo_id, $path, $string, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->upload_file($repo_id, $path, $file, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->delete_file($repo_id, $path, $commit_message = "Delete File", $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->delete_folder($repo_id, $path, $commit_message = "Delete Folder", $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->download_file($repo_id, $file, $path, $repo_type = 'model', $revision = 'main')
# List operations
$api->list_files($repo_id, $repo_path = '', $repo_type = 'model', $revision = 'main')
# Update operations
$api->update_repo_visibility($repo_id, $private, $repo_type = 'model')
# User operations
$api->whoami()
# Inference APIs
$api->generate($model_id, $inputs, $min_length = 0, $max_length = 256, $top_k	= null, $top_p = null, $temperature = 1.0, $repetition_penalty = null, $max_time = 120, $do_sample = null, $use_cache = false, $wait_for_model = true)
```

## Porting

This library is designed to be easy to port! Please open an Issue if you're interested in porting this library. If this library is ported to enough languages, it might be good to create a centralized GitHub organization.

## Credits/Acknowledgements

The entire library is basically a reimplementation of the [`huggingface_hub` library](https://github.com/huggingface/huggingface_hub) in PHP, with modifications to make it more portable. The API implementation is almost completely based on that library.

## License

This software is licensed under the Mozilla Public License, version 2.0. The Mozilla Public License encourages sharing, however it does not have the same restrictions as the GNU General Public License, as it does *not* require linked software to be licensed under the same license. If you have any questions about the license, please open an Issue on GitHub.