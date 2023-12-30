<?php
class Hub
{
    # Protected Variables
    protected string $token;
    # Public Variables
    public string $useragent = 'mrfakename/hfhubphp; php/' . PHP_VERSION;
    public string $base_url = 'https://huggingface.co/';
    # Internal Functions
    private function _create_headers($token = null)
    {
        if (!$token)
            $token = $this->token;
        return [
            "authorization: Bearer $token",
            'user-agent: ' . $this->useragent
        ];
    }
    private function _validate_type($repo_type)
    {
        if (!in_array($repo_type, ['model', 'dataset', 'space'])) {
            throw new \Exception('Your repo type must be model|dataset|space');
        }
    }
    private function _cgc($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_create_headers());
        $content = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $content;
    }
    # Construct
    public function __construct($token)
    {
        $this->token = $token;
    }
    # Public Functions
    # Repo Functions
    public function create_repo($repo_id, $repo_type = 'model', $private = False)
    {
        $this->_validate_type($repo_type);
        list($repouser, $reponame) = explode('/', $repo_id, 2);
        $payload = [
            'name' => $reponame,
            'organization' => $repouser,
            'type' => $repo_type,
            'private' => $private ? 'true' : 'false'
        ];
        $body = $payload;
        $headers = $this->_create_headers();
        $ch = curl_init($this->base_url . 'api/repos/create');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function update_repo_visibility($repo_id, $private, $repo_type = 'model')
    {
        $payload = [
            'private' => $private ? 'true' : 'false'
        ];
        $body = $payload;
        $headers = $this->_create_headers();
        $ch = curl_init($this->base_url . "api/" . $repo_type . "s/$repo_id/settings");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function delete_repo($repo_id, $repo_type = 'model')
    {
        $this->_validate_type($repo_type);
        list($repouser, $reponame) = explode('/', $repo_id, 2);

        $payload = [
            'name' => $reponame,
            'organization' => $repouser,
            'type' => $repo_type
        ];
        $body = $payload;
        $headers = $this->_create_headers();
        $ch = curl_init($this->base_url . 'api/repos/delete');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($response == "OK") {
            return true;
        }
        return json_decode($response, true);
    }
    public function move_repo($from_id, $to_id, $repo_type = 'model')
    {
        $this->_validate_type($repo_type);

        $payload = [
            'fromRepo' => $from_id,
            'toRepo' => $to_id,
            'type' => $repo_type
        ];
        $body = $payload;
        $headers = $this->_create_headers();
        $ch = curl_init($this->base_url . 'api/repos/move');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($response == "OK") {
            return true;
        }
        return json_decode($response, true);
    }

    public function upload_string($repo_id, $path, $string, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
    {
        $this->_validate_type($repo_type);
        $payload = [
            json_encode([
                "key" => "header",
                "value" => [
                    "summary" => $commit_message,
                    "description" => $commit_description
                ]
            ]),
            json_encode([
                "key" => "file",
                "value" => [
                    "content" => base64_encode($string),
                    "path" => $path,
                    "encoding" => "base64"
                ]
            ])
        ];
        $items = implode("\n", $payload);
        $url = $this->base_url . 'api/' . $repo_type . "s/$repo_id/commit/$revision";
        $headers = $this->_create_headers();
        $headers = array_push($headers, "content-type: application/x-ndjson");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $items);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function delete_file($repo_id, $path, $commit_message = "Delete File", $commit_description = null, $revision = 'main', $repo_type = 'model')
    {
        $this->_validate_type($repo_type);
        $payload = [
            json_encode([
                "key" => "header",
                "value" => [
                    "summary" => $commit_message,
                    "description" => $commit_description
                ]
            ]),
            json_encode([
                "key" => "deletedFile",
                "value" => [
                    "path" => $path
                ]
            ])
        ];
        $items = implode("\n", $payload);
        $url = $this->base_url . 'api/' . $repo_type . "s/$repo_id/commit/$revision";
        $headers = $this->_create_headers();
        $headers = array_push($headers, "content-type: application/x-ndjson");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $items);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function delete_folder($repo_id, $path, $commit_message = "Delete Folder", $commit_description = null, $revision = 'main', $repo_type = 'model')
    {
        $this->_validate_type($repo_type);
        $payload = [
            json_encode([
                "key" => "header",
                "value" => [
                    "summary" => $commit_message,
                    "description" => $commit_description
                ]
            ]),
            json_encode([
                "key" => "deletedFolder",
                "value" => [
                    "path" => $path
                ]
            ])
        ];
        $items = implode("\n", $payload);
        $url = $this->base_url . 'api/' . $repo_type . "s/$repo_id/commit/$revision";
        $headers = $this->_create_headers();
        $headers = array_push($headers, "content-type: application/x-ndjson");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $items);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function upload_file($repo_id, $path, $file, $commit_message, $commit_description = null, $revision = 'main', $repo_type = 'model')
    {
        return $this->upload_string($repo_id, $path, file_get_contents($file), $commit_message, $commit_description, $revision, $repo_type);
    }
    # User Functions
    public function whoami()
    {
        return json_decode($this->_cgc($this->base_url . 'api/whoami-v2'), true);
    }
    # Download Functions
    public function download_file($repo_id, $file, $path, $repo_type = 'model', $revision = 'main')
    {
        $this->_validate_type($repo_type);
        $revision = rawurlencode($revision);
        if ($repo_type == 'model') {
            $ch = curl_init($this->base_url . rawurlencode($repo_id) . "/resolve/$revision/" . rawurlencode($file));
        }
        $file = fopen($path, 'w');
        curl_setopt($ch, CURLOPT_FILE, $file);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            fclose($file);
            throw new \Exception('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
        fclose($file);
        return true;
    }
}