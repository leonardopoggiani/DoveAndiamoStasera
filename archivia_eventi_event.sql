USE pweb;
SET GLOBAL event_scheduler = ON;

DROP EVENT IF EXISTS archivia_prenotazione;

DELIMITER $$

CREATE EVENT archivia_prenotazione
    ON SCHEDULE EVERY 1 MINUTE STARTS CURRENT_TIMESTAMP
DO BEGIN

    INSERT INTO eventi_archiviati
    SELECT 0, titolo,luogo FROM eventi
    WHERE dataevento < CURRENT_TIMESTAMP;
    
    DELETE FROM eventi WHERE  dataevento < CURRENT_TIMESTAMP;
    
END $$
DELIMITER ;