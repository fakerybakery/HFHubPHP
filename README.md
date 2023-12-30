**Important:** This package currently does not support LFS files

# HFHubPHP Alpha

A PHP library for interacting with the Hugging Face Hub. Everything is done in a single file, so

## Todo

- [ ] Inference APIs
- [ ] User
  - [x] Whoami
- [ ] Repo Operations
  - [x] Create
    - [ ] Full HF Spaces support
  - [x] Delete
  - [x] Move
  - [x] Update Visibility
  - [x] Files
    - [x] Create
    - [x] Download
    - [x] Delete
  - [ ] Folder
    - [x] Delete
  - [ ] Later: Add LFS support

## Documentation

More documentation coming soon!

```php
include 'hub.php';
$api = new Hub('hf_***');
```

## Methods

```php
$api->create_repo($repo_id, $repo_type = 'model', $private = False);
$api->delete_repo($repo_id, $repo_type = 'model')
$api->move_repo($from_id, $to_id, $repo_type = 'model')

$api->upload_string($repo_id, $path, $string, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->upload_file($repo_id, $path, $file, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->delete_file($repo_id, $path, $commit_message = "Delete File", $commit_description = null, $revision = 'main', $repo_type = 'model')
$api->delete_folder($repo_id, $path, $commit_message = "Delete Folder", $commit_description = null, $revision = 'main', $repo_type = 'model')

$api->download_file($repo_id, $file, $path, $repo_type = 'model', $revision = 'main')

$api->update_repo_visibility($repo_id, $private, $repo_type = 'model');
$api->
whoami()
```

## License

This software is currently not licensed. We plan to add a license soon.