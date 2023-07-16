<?php
    session_unset();
    session_destroy();
	Header("Location: /member/login");