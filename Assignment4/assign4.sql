-- Assignment #4
-- Clare Minnerath


-- Query #1
-- Find names of crew members in order

SELECT name, job
FROM crew
ORDER BY job, name;


-- Query #2
-- Total number of pilots in the database

SELECT count(*) AS numPilots
FROM crew
WHERE job = 'pilot';


-- Query #3
-- Distinct names of destination airports

SELECT DISTINCT dest
FROM flightinfo;


-- Query #4
-- Passenger names from flight 'aa 73' on Nov. 19th

SELECT name
FROM passenger NATURAL JOIN reservation
WHERE airline = 'aa' AND flightnbr = 73;


-- Query #5
-- Find departure with no passengers

SELECT airline, flightnbr, segnbr, date
FROM departure d
WHERE NOT EXISTS(SELECT *
				FROM reservation r
				WHERE d.airline = r.airline AND d.flightnbr = r.flightnbr AND d.segnbr = r.segnbr AND d.date = r.date);
				
		
-- Query #6
-- Find departure with no non-crew passengers

SELECT d.airline, d.flightnbr, d.segnbr, d.date
FROM departure d
WHERE NOT EXISTS(SELECT *
				FROM reservation r
				WHERE d.airline = r.airline AND d.flightnbr = r.flightnbr AND d.segnbr = r.segnbr AND d.date = r.date AND r.ssn NOT IN(SELECT c.ssn FROM crew c));
									
									

-- Query #7
-- Find crew who pilot planes through heathrow

SELECT c.ssn, c.name
FROM crew c NATURAL JOIN schedule NATURAL JOIN departure NATURAL JOIN flightinfo
WHERE c.job = 'pilot' AND (origin = 'heathrow' OR dest = 'heathrow');


-- Query #8
-- Find flights with last segment ending in 'jfk'

SELECT *
FROM flightinfo f
WHERE segnbr = (SELECT MAX(segnbr)
				FROM flightinfo f2
				WHERE f.flightnbr = f2.flightnbr
				ORDER BY f.flightnbr) AND f.dest = 'jfk';
				


-- Query #9
-- Find crew who have never taken off or landed in 'ohare'

SELECT DISTINCT c.ssn, c.name
FROM crew c
WHERE NOT EXISTS(SELECT *
				FROM schedule s, departure d, flightinfo f
				WHERE c.ssn = s.ssn AND s.airline = d.airline AND s.flightnbr = d.flightnbr AND s.segnbr = d.segnbr AND s.date = d.date 
				AND f.airline = d.airline AND f.flightnbr = d.flightnbr AND f.segnbr = d.segnbr AND (f.origin = 'ohare' OR f.dest = 'ohare'))
				AND NOT EXISTS(SELECT *
				FROM reservation r, departure d, flightinfo f
				WHERE c.ssn = r.ssn AND r.airline = d.airline AND r.flightnbr = d.flightnbr AND r.segnbr = d.segnbr AND r.date = d.date 
				AND f.airline = d.airline AND f.flightnbr = d.flightnbr AND f.segnbr = d.segnbr AND (f.origin = 'ohare' OR f.dest = 'ohare'));


-- Query #10
-- Find pilots who both pilot and are passengers on the same flight segments

SELECT DISTINCT c.ssn, c.name
FROM crew c, reservation r, schedule s
WHERE c.job = 'pilot' AND c.ssn = r.ssn AND c.ssn = s.ssn AND r.airline = s.airline AND r.flightnbr = s.flightnbr AND r.segnbr = s.segnbr;


-- Query #11
-- Find passengers who book entire flights

SELECT DISTINCT p.ssn, p.name, r.airline, r.flightnbr, r.date
FROM passenger p, reservation r
WHERE p.ssn = r.ssn AND (SELECT MAX(segnbr)
						FROM reservation r2	
						WHERE r.flightnbr = r2.flightnbr AND r.date = r2.date
						GROUP BY r.flightnbr) = (SELECT COUNT(segnbr)
												FROM reservation r3
												WHERE p.ssn = r3.ssn AND r.flightnbr = r3.flightnbr AND r.date = r3.date
												GROUP BY r.flightnbr);
																	


-- Query #12
-- Non-crew passenger pairs where pass. 1 takes at least all flights of pass. 2

SELECT p1.ssn, p2.ssn
FROM passenger p1, passenger p2
WHERE p1.ssn != p2.ssn AND NOT EXISTS(SELECT * FROM crew c WHERE p1.ssn = c.ssn OR p2.ssn = c.ssn) 
						AND NOT EXISTS(SELECT *
						FROM reservation r
						WHERE r.ssn = p2.ssn AND NOT EXISTS(SELECT *
									FROM reservation r2
									WHERE r2.ssn = p1.ssn AND r.flightnbr = r2.flightnbr AND r.airline = r2.airline 
									AND r.segnbr = r2.segnbr AND r.date = r2.date)
		);
				
				
-- Query #13
-- Non-crew passenger pairs where pass. 1 takes non of the departures of pass. 2

SELECT p1.ssn, p2.ssn
FROM passenger p1, passenger p2
WHERE p1.ssn != p2.ssn AND NOT EXISTS(SELECT * FROM crew c WHERE p1.ssn = c.ssn OR p2.ssn = c.ssn) 
					AND NOT EXISTS(SELECT *
							FROM reservation r
							WHERE r.ssn = p2.ssn AND EXISTS(SELECT *
									FROM reservation r2
									WHERE r2.ssn = p1.ssn AND r.flightnbr = r2.flightnbr AND r.airline = r2.airline 
									AND r.segnbr = r2.segnbr AND r.date = r2.date)
					);
				
				
-- Query #14
-- Find non-crew passangers and thier new earned airmiles

SELECT p.ssn, p.name, SUM(f.airmiles) AS NewAirmiles
FROM passenger p, flightinfo f, departure d, reservation r
WHERE p.ssn = r.ssn AND r.airline = d.airline AND r.flightnbr = d.flightnbr AND r.segnbr = d.segnbr AND r.date = d.date AND
	f.airline = d.airline AND f.flightnbr = d.flightnbr AND f.segnbr = d.segnbr AND NOT EXISTS(SELECT * FROM crew c WHERE p.ssn = c.ssn)
GROUP BY p.ssn;


-- Query #15
-- Retrieve total of non-crew passengers airmiles

SELECT p.ssn, SUM(f.airmiles) + p.miles AS TotalMiles
FROM passenger p, flightinfo f, departure d, reservation r
WHERE p.ssn = r.ssn AND r.airline = d.airline AND r.flightnbr = d.flightnbr AND r.segnbr = d.segnbr AND r.date = d.date AND
	f.airline = d.airline AND f.flightnbr = d.flightnbr AND f.segnbr = d.segnbr AND NOT EXISTS(SELECT * FROM crew c WHERE p.ssn = c.ssn)
GROUP BY p.ssn;






				