# Inference API

### Method

```php
$api->generate
```

## Parameters

* **model_id**: Model ID on the HF Hub
* **inputs**: Input text
* **min_length**: Minimum number of tokens to generate (default 0)
* **max_length**: Maximum number of tokens to generate (default 256)
* **top_k**: Top K (default null)
* **top_p**: Top P (default null)
* **temperature**: Temperature (default 1.0)
* **repetition_penalty**: Repetition penalty (default null)
* **max_time**: Maximum generation time (default 120 seconds, can range from 1s to 120s)
* **do_sample**: Sample (default null)
* **use_cache**: Cache responses (default null)
* **wait_for_model**: Wait for model to load before generating, instead of erroring if model isn't loaded (default True)

## Example

Complete the text "Hello:"

```php
include 'hub.php';
$api = new Hub('hf_***');
echo($api->generate('gpt2', 'Hello')['generated_text']); 
```