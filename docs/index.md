# Introduction

*A portable (in both senses, easily installable and easy to port), fast, and simple wrapper for the Hugging Face Hub APIs, similar to the HF Hub Python library.*

A PHP library for interacting with the Hugging Face Hub. Everything is done in a single file, so all you have to do is drag the file in and import it with `include`!

**This library is designed to be *portable*, *simple*, and *easily portable* to another language.** If you're interested in porting this library to another language, please see the Porting section below!

## Features

We aim to support the following methods, with similar APIs as the original `huggingface_hub` Python library:

- User Management
  - Whoami
- Repo Operations
  - Create Repo
    - HF Spaces support
  - Delete Repo
  - Move Repo
  - Update Repo Visibility
  - Repo File Management
    - Create
    - Download
    - Delete
    - List
  - Repo Folder Management
    - Delete

!!! note
    Unfortunately, large files (Git LFS) are not supported at this time. Please use `libgit2` PHP bindings or the Python library instead.
