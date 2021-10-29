<?php

function getBaseURL() {
    $protocol = strtolower(explode('/', $_SERVER['SERVER_PROTOCOL'])[0]);
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . '://' . $host;
}

function formatToBrazilianMoney($value) {
    return number_format($value, 2, ',', '.');
}

function setLinkActiveClass(string $link) {
  $actualPageURI = explode('.', $_SERVER['REQUEST_URI'])[0];
  $actualPage = $actualPageURI === '/' ? 'home' : end(explode('/', $actualPageURI));
  return $actualPage === $link ? 'active' : '';
}