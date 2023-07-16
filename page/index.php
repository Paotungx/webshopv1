<?php

if (!isset($_SESSION["logging"])) {
    Header("Location: /member/home");
} else {
    Header("Location: /member/home");
};
