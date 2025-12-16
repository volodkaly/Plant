    INSERT INTO plant
     (
         name,
         description,
         min_number_of_days_to_water,
         max_number_of_days_to_water,
         fertilizers,
         last_watering_date,
         created_at,
         height,
         volume_of_water_in_mlper_cmof_height
     )
    VALUES
     -- 🔴 Overdue (0 days left)
     ('Overdue Fern', 'Needs urgent watering', 3, 5, 'Organic', '2025-12-05', '2025-12-01 09:00:00', 45, 4),
     ('Dry Palm', 'Soil completely dry', 4, 6, 'Manure', '2025-12-06', '2025-12-01 09:00:00', 120, 6),
     ('Wilted Lily', 'Leaves starting to droop', 2, 4, 'NPK', '2025-12-07', '2025-12-01 09:00:00', 55, 5),
     ('Thirsty Monstera', 'Large leaves losing firmness', 5, 7, 'NPK,Compost', '2025-12-08', '2025-12-01 09:00:00', 140, 7),
     ('Crispy Calathea', 'Edges turning brown', 3, 5, 'Organic', '2025-12-06', '2025-12-01 09:00:00', 38, 4),

     -- 🟧 1 day left
     ('Almost Dry Pothos', 'Water soon', 4, 6, 'Organic', '2025-12-10', '2025-12-01 09:00:00', 60, 3),
     ('Ficus Warning', 'Close to watering limit', 5, 7, 'Compost', '2025-12-10', '2025-12-01 09:00:00', 90, 4),
     ('Near Dry Dracaena', 'Water tomorrow', 6, 8, 'Manure', '2025-12-09', '2025-12-01 09:00:00', 110, 5),
     ('Drying Areca', 'Top soil dry', 4, 6, 'NPK', '2025-12-10', '2025-12-01 09:00:00', 130, 6),
     ('Warning Rubber Plant', 'Needs attention', 5, 7, 'NPK,Compost', '2025-12-10', '2025-12-01 09:00:00', 95, 5),

     -- 🟨 2 days left
     ('Soon Dry Spider Plant', 'Water in two days', 3, 6, 'Organic', '2025-12-11', '2025-12-01 09:00:00', 35, 3),
     ('Yucca Alert', 'Approaching dry cycle', 7, 9, 'Compost', '2025-12-11', '2025-12-01 09:00:00', 115, 4),
     ('Palm Edge Case', 'Borderline watering time', 6, 8, 'Manure', '2025-12-11', '2025-12-01 09:00:00', 150, 6),
     ('Schefflera Soon', 'Prepare watering', 4, 6, 'NPK', '2025-12-11', '2025-12-01 09:00:00', 85, 5),
     ('Peace Lily Soon', 'Almost thirsty', 2, 4, 'Organic', '2025-12-11', '2025-12-01 09:00:00', 40, 4),

     -- 🔴 Edge + zero height / null fertilizer (UI stress test)
     ('Critical Test Zero', 'Critical with zero height', 1, 2, NULL, '2025-12-09', '2025-12-01 09:00:00', 0, 1),
     ('Critical Null Fert', 'Overdue without fertilizer', 2, 3, NULL, '2025-12-08', '2025-12-01 09:00:00', 50, 3),
     ('Last Chance Plant', 'Last possible watering day', 3, 5, 'Organic', '2025-12-10', '2025-12-01 09:00:00', 70, 4),
     ('Emergency Green', 'Emergency watering required', 2, 4, 'NPK,Manure', '2025-12-07', '2025-12-01 09:00:00', 65, 5),
     ('Dry Test Subject', 'UI color stress test', 4, 6, 'Compost', '2025-12-06', '2025-12-01 09:00:00', 55, 3);
