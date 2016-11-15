<?php
namespace Biganashvili\Google;

class GoogleSearch
{
    private $client;

    public function __construct($guzzleHttpClient)
    {
        $this->client = $guzzleHttpClient;
    }

    public function getSearchResultsCount($keyword)
    {
        $html = $this->getResponse($keyword);
        if ($html !== false) {
            $from = 'About ';
            $to = ' results';
            return $this->find_between($html, $from, $to);
        } else {
            return false;
        }
    }

    private function getResponse($keyword)
    {
        $google_uri = "https://www.google.com/search?sclient=psy-ab&biw=1280&bih=479&q=&oq=&gs_l=hp.12..0j0i10k1l3.1118.1118.2.2450.1.1.0.0.0.0.160.160.0j1.1.0....0...1.1.64.psy-ab..0.1.154.jmtYQqeJWyE&pbx=1&bav=on.2,or.&bvm=bv.138493631,d.bGg&fp=02c43ad782f8818f&tch=1&ech=1&psi=UropWMXDCoHHsgHSj5WgBQ.1479129682492.5";
        $res = $this->client->request('GET', str_replace(array("&q=", "&oq="), array("&q=" . urlencode($keyword), "&oq=" . urlencode($keyword)), $google_uri), [
            'allow_redirects' => [
                'max' => 10,        // allow at most 10 redirects.
                'strict' => true,      // use "strict" RFC compliant redirects.
                'referer' => true,      // add a Referer header
                'protocols' => ['https'], // only allow https URLs
                'track_redirects' => true
            ]
        ]);
        if ($res->getStatusCode() == 200) {
            return $res->getBody();
        } else {
            return false;
        }
    }


    private function find_between($string, $start, $end, $greedy = false)
    {
        $pattern = '/' . preg_quote($start) . '(.*';
        if (!$greedy) $pattern .= '?';
        $pattern .= ')' . preg_quote($end) . '/';
        preg_match($pattern, $string, $matches);
        return str_replace(',', '', $matches[1]);
    }
}

?>
