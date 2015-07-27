SET @countryCode = ':countryCode';
SET @price = :price;
SET @currency = ':currency';
SET @idProviderType = 3;
SET @defaultItem = 0;
SET @provider = :idProvider;
SET @payoutPremiumPoker = :payoutPremiumPoker; -- PO/FA/DI
SET @payoutPremiumCafe = :payoutPremiumCafe; -- CA/FS
SET @payoutPremiumGalaxy = :payoutPremiumGalaxy; -- MA/EM/GX/BF/SK/LHm

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '1', '1', '1', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 3, @payoutPremiumPoker * 1000); -- Poker normal
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '1', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 4, @payoutPremiumPoker); -- Poker premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '7', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 8, @payoutPremiumPoker); -- Disco premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '5', '1', '1', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 6, @payoutPremiumCafe * 1000); -- Cafe normal
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '5', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 7, @payoutPremiumCafe); -- Cafe premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '10', '1', '1', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 1, @payoutPremiumCafe * 1000); -- Fashion normal
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '10', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 2, @payoutPremiumCafe); -- Fashion premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '4', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 5, @payoutPremiumGalaxy); -- Gangster premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '12', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 12, @payoutPremiumGalaxy); -- Empire premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '14', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 9, @payoutPremiumGalaxy); -- Galaxy premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '15', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 11, @payoutPremiumGalaxy); -- BF premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '21', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 249, @payoutPremiumGalaxy); -- SK premium
COMMIT;

START TRANSACTION;
INSERT INTO `shop`.`item` (`id`, `idGame`, `idNetwork`, `idItemCategory`, `idProviderType`, `isDefault`, `active`, `countryCode`, `price`, `idProvider`, `currencyCode`, `providerSpecific`)
VALUES (NULL, '23', '1', '2', @idProviderType, @defaultItem, '1', @countryCode, @price, @provider, @currency, NULL);
INSERT INTO `shop`.`itemPayout` (`idItem`, `idGameCurrency`, `amount`) VALUES (LAST_INSERT_ID(), 397, @payoutPremiumGalaxy); -- LHw premium
COMMIT;