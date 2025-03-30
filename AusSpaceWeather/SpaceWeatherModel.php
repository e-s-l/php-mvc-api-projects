<?php

class SpaceWeatherModel {

    private $apiKey;
    private $endPointRoot;

    const VALID_LOCATIONS = [
        "Sydney", "Melbourne", "Perth", "Hobart", "Darwin", "Canberra", 
        "Macquarie Island", "Casey", "Mawson", "Australian region"
    ];

    const ALERTS = [
        "auroraAlert" => [
            "label" => "Aurora Alert",
            "info" => "An aurora alert..."
        ],
        "auroraOutlook" => [
            "label" => "Aurora Outlook",
            "info" => "An aurora outlook.."
        ],
        "auroraWatch" => [
            "label" => "Aurora Watch",
            "info" => "An aurora watch..."
        ],
        "magAlert" => [
            "label" => "Mag Alert",
            "info" => "A geomagnetic alert..."
        ],
        "magWarning" => [
            "label" => "Mag Warning",
            "info" => "A geomagnetic warning..."
        ]
    ];

    const INDICES = [
        "kIndex" => [
            "label" => "K Index",
            "info" => "The K Index measures..."
        ],
        "aIndex" => [
            "label" => "A Index",
            "info" => "The A Index is..."
        ],
        "dstIndex" => [
            "label" => "DST Index",
            "info" => "The DST Index..."]
    ];

    /*
    ********************
    * public functions *
    ********************
    */

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
        $this->endPointRoot = 'https://sws-data.sws.bom.gov.au/api/v1/';
    }

    /**
     * Given an instatiated object, return the constants.
     * (But note, can just use Class:Const)
     */

    public function getLocations() : array {
        return self::VALID_LOCATIONS;
    }

    public function getAlerts() : array {
        return self::ALERTS;
    }

    public function getIndices() : array {
        return self::INDICES;
    }

    /**
     * The primary public function.
     * Construct a mixed data (ints, strings or nulls) array to pass to the view.
     */
    public function getSpaceWeatherData(string $date = "", string $location = "") : array {

        $dataArray = [
            'kIndex' => $this->getKIndex($date, $location),
            'aIndex' => $this->getAIndex($date),
            'dstIndex' => $this->getDstIndex($date),
            'auroraAlert' => $this->getAlert(),
            'auroraOutlook' => $this->getOutlook(),
            'auroraWatch' => $this->getWatch(),
            'magAlert' => $this->getMagAlert(),
            'magWarning' => $this->getMagWarning()
        ];
        return $dataArray;
    }

    /*
    *********************
    * private functions *
    *********************
    */

    /**
     * Make the API requests.
     */
    private function fetchData(string $endpoint, array $body) {

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json; charset=UTF-8",
                'content' => json_encode($body),
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->endPointRoot . $endpoint, false, $context);

        if ($response === FALSE) {
            return "Error fetching data";
        }

        $result = json_decode($response, true);

        return isset($result['data']) ? $result['data'] : $result['errors'];
    }

    private function getKIndex(string $date = "", string $location = "Australian region") : int|null {

        $endpoint = "get-k-index";

        if ($date === date('Y-m-d')) {
            $start = "";
            $end = "";
        } else {
            $start = $date . ' 00:00:00';
            $end = $date . ' 24:00:00';
        }

        $body = [
            "api_key" => $this->apiKey,
            "options" => [
                "location" => $location,
                "start" => $start,
                "end" => $end
            ]
        ];

        $result = $this->fetchData($endpoint, $body);
        return isset($result[0]['index']) && is_numeric($result[0]['index']) ? $result[0]['index'] : null;
    }

    private function getAIndex(string $date = "") : int|null {

        $endpoint = "get-a-index";

        if ($date === date('Y-m-d')) {
            $start = "";
            $end = "";
        } else {
            $start = $date . ' 00:00:00';
            $end = $date . ' 24:00:00';
        }

        $body = [
            "api_key" => $this->apiKey,
            "options" => [
                "location" => "Australian region",
                "start" => $start,
                "end" => $end
            ]
        ];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0][0]['index']) && is_numeric($result[0][0]['index']) ? $result[0][0]['index'] : null;
    }

    private function getDstIndex(string $date = "") : int|null {
        $endpoint = "get-dst-index";
        if ($date === date('Y-m-d')) {
            $start = "";
            $end = "";
        } else {
            $start = $date . ' 00:00:00';
            $end = $date . ' 24:00:00';
        }
        $body = [
            "api_key" => $this->apiKey,
            "options" => [
                "location" => "Australian region",
                "start" => $start,
                "end" => $end
            ]
        ];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0][0]['index']) && is_numeric($result[0][0]['index']) ? $result[0][0]['index'] : null;
    }

    /****************************************/

    private function getAlert() : array|null {
        $endpoint = "get-aurora-alert";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0]) ? $result[0] : null;
    }

    private function getOutlook() : array|null {
        $endpoint = "get-aurora-outlook";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        //return $result[0] ?? null;
        return isset($result[0]) ? $result[0] : null;
    }

    private function getWatch() : array|null {
        $endpoint = "get-aurora-watch";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0]) ? $result[0] : null;
    }

    private function getMagAlert() : array|null {
        $endpoint = "get-mag-alert";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0]) ? $result[0] : null;
    }

    private function getMagWarning() : array|null {
        $endpoint = "get-mag-warning";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return isset($result[0]) ? $result[0] : null;
    }
}
?>
