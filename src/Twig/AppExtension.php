<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFr', [$this, 'dateFr']),
            new TwigFilter('formatPhone', [$this, 'formatPhone']),
        ];
    }
    public function formatPrice($number, $symbol = '€', $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price . ' ' . $symbol;

        return $price;
    }
    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }

        return $html;
    }
    public function dateFr()
    {
        $date = new \DateTime();
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        return $formatter->format($date);
    }
    public function formatPhone($phone)
    {
        return preg_replace('/(\d{2})(?=\d)/', '$1 ', $phone);
    }
}