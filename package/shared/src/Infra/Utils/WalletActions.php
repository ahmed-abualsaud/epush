<?php

namespace Epush\Shared\Infra\Utils;

enum WalletActions : string {

    case SET = "set";

    case REFUND = "refund";

    case DEDUCT = "deduct";

}