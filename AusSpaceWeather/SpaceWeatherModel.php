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

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
        $this->endPointRoot = 'https://sws-data.sws.bom.gov.au/api/v1/';
    }

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

    private function getKIndex(string $date = "", string $location = "Australian region") {

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
        return $result[0]['index'] ?? null;
    }

    private function getAIndex(string $date = "") {

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
        return $result[0][0]['index'] ?? null;
    }

    private function getDstIndex(string $date = "") {
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
        return $result[0][0]['index'] ?? null;
    }

    private function getAlert() {
        $endpoint = "get-aurora-alert";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return $result[0] ?? null;
    }

    private function getOutlook() {
        $endpoint = "get-aurora-outlook";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return $result[0] ?? null;
    }

    private function getWatch() {
        $endpoint = "get-aurora-watch";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return $result[0] ?? null;
    }

    private function getMagAlert() {
        $endpoint = "get-mag-alert";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return $result[0] ?? null;
    }

    private function getMagWarning() {
        $endpoint = "get-mag-warning";
        $body = ["api_key" => $this->apiKey];
        $result = $this->fetchData($endpoint, $body);
        return $result[0] ?? null;
    }

    public function getSpaceWeatherData(string $date = "", string $location = "") : array {

        $dataArray = [
            'kIndex' => (string) $this->getKIndex($date, $location),
            'aIndex' => (string) $this->getAIndex($date),
            'dstIndex' => (string) $this->getDstIndex($date),
            'auroraAlert' => (string) $this->getAlert(),
            'auroraOutlook' => (string) $this->getOutlook(),
            'auroraWatch' => (string) $this->getWatch(),
            'magAlert' => (string) $this->getMagAlert(),
            'magWarning' => (string) $this->getMagWarning()
        ];
        return $dataArray;
    }

    public function getLocations() : array {
        return self::VALID_LOCATIONS;
    }

    public function getAlerts() : array {
        return self::ALERTS;
    }

    public function getIndices() : array {
        return self::INDICES;
    }

}
?>
