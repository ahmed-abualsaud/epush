<?php

namespace Epush\Shared\Infra\Utils;

enum Settings : string {

    case MESSAGE_APPROVEMENT_LIMIT = "Message Approvement Limit";

    case MAXIMUM_NUMBER_OF_MESSAGES_SEGMENTS = "Maximum Number of Messages Segments";

    case DEFAULT_COUNTRY_CODE = "Default Country Code";
    
    case WORD_FILTER_THRESHOLD = "Word Filter Threshold";
}