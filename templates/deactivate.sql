UPDATE `shop`.`item`
SET `item`.`active` = 0
WHERE `item`.`countryCode` = ':countryCode'
      AND `item`.`idProviderType` = 3
      AND `item`.`idProvider` = 10
      AND `item`.`active` = 1
