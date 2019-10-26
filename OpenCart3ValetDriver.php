<?php

class OpenCart3ValetDriver extends ValetDriver
{
    private $frontControllers = ['/admin', '/install'];

    /**
     * Determine if the driver serves the request.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     *
     * @return bool
     */
    public function serves($sitePath, $siteName, $uri)
    {
        return file_exists($sitePath . '/.oc3-valet.json');
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     *
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if ($this->frontControllerUri($uri) === rtrim($uri, '/')) {
            return false;
        }

        if (! file_exists($staticFilePath = $sitePath . $this->getWebRoot($sitePath) . $uri)) {
            return false;
        }
        return $staticFilePath;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     *
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        $frontControllerUri = $this->frontControllerUri($uri);
        if (! is_null($frontControllerUri)) {
            return $sitePath . $this->getWebRoot($sitePath) . $frontControllerUri . '/index.php';
        }

        return $sitePath . $this->getWebRoot($sitePath) . '/index.php';
    }

    /**
     * @param $uri
     *
     * @return string|null
     */
    public function frontControllerUri($uri)
    {
        foreach ($this->frontControllers as $frontControllerUri) {
            if (startsWith($uri, $frontControllerUri)) {
                return $frontControllerUri;
            }
        }
        return null;
    }

    public function getWebRoot($sitePath)
    {
        return $this->config($sitePath, 'root', '');
    }

    /**
     * @param $sitePath
     *
     * @param $key
     * @param null $defaultValue
     *
     * @return mixed
     */
    protected function config($sitePath, $key, $defaultValue = null)
    {
        $configJson = file_get_contents($sitePath . '/.oc3-valet.json');
        $config = json_decode($configJson, true);
        return $config[$key] ?? $defaultValue;
    }
}

if (! function_exists('startsWith')) {
    // Function to check string starting with given substring
    function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
