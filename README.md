**Important:** This package currently does not support LFS files

# HFHubPHP Alpha

**[Docs](https://fakerybakery.github.io/HFHubPHP/)**

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

## Porting

This library is designed to be easy to port! Please open an Issue if you're interested in porting this library. If this library is ported to enough languages, it might be good to create a centralized GitHub organization.

## Important

This project is not affiliated with or endorsed by Hugging Face, Inc. in any way whatsoever.

## Credits/Acknowledgements

The entire library is basically a reimplementation of the [`huggingface_hub` library](https://github.com/huggingface/huggingface_hub) in PHP, in a single file. The API implementation is almost completely based on that library.

## License

This software is licensed under the Mozilla Public License, version 2.0. The Mozilla Public License encourages sharing, however it does not have the same restrictions as the GNU General Public License, as it does *not* require linked software to be licensed under the same license. If you have any questions about the license, please open an Issue on GitHub.