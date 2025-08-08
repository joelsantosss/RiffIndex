-- In phpMyAdmin, create a database called RiffIndex (matches hardcoded host in db_connect.php), 
-- and then paste this script into the SQL window under the RiffIndex database.

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('member', 'admin') NOT NULL,
    phone VARCHAR(15),
    image VARCHAR(255)
);

CREATE TABLE bands (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date_created DATE NOT NULL,
    members TEXT NOT NULL,
    activity_status ENUM('active', 'inactive') NOT NULL,
    genre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL 
);

CREATE TABLE band_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    band_name VARCHAR(255) NOT NULL,
    date_created DATE,
    members TEXT,
    genre VARCHAR(100),
    description TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    reason TEXT,
    activity_status ENUM('active', 'inactive') NOT NULL
);


-- insert sample data including band descriptions
INSERT INTO bands (name, date_created, members, activity_status, genre, description) VALUES
('Nirvana', '1987-01-01', 'Kurt Cobain, Krist Novoselic, Dave Grohl', 'inactive', 'alt rock', 'Nirvana was a groundbreaking alternative rock band known for their raw sound and the influence of Kurt Cobain. Their album "Nevermind" changed the landscape of rock music forever.'),
('Foo Fighters', '1994-01-01', 'Dave Grohl, Nate Mendel, Chris Shiflett, Taylor Hawkins', 'active', 'alt rock', 'Formed by Dave Grohl after the end of Nirvana, the Foo Fighters became a leading rock band of the late 1990s and 2000s with energetic performances and anthemic hits like "Everlong".'),
('The Rolling Stones', '1962-01-01', 'Mick Jagger, Keith Richards, Charlie Watts, Ronnie Wood', 'active', 'classic rock', 'A legendary rock band known for their blues-influenced rock music, The Rolling Stones have become cultural icons with hits like "Paint It Black" and "Start Me Up".'),
('Led Zeppelin', '1968-01-01', 'Robert Plant, Jimmy Page, John Paul Jones, John Bonham', 'inactive', 'classic rock', 'Led Zeppelin is considered one of the greatest and most influential rock bands in history, blending hard rock, blues, and psychedelic sounds in timeless albums like "IV" and "Physical Graffiti".'),
('AC/DC', '1973-01-01', 'Angus Young, Brian Johnson, Malcolm Young, Cliff Williams', 'active', 'hard rock', 'Known for their electrifying performances and straightforward hard rock anthems, AC/DC has been a cornerstone of the genre with albums like "Back in Black" and "Highway to Hell".'),
('Guns N\' Roses', '1985-01-01', 'Axl Rose, Slash, Duff McKagan, Izzy Stradlin', 'active', 'hard rock', 'Guns N\' Roses revolutionized hard rock with their debut album "Appetite for Destruction", combining elements of punk, heavy metal, and classic rock.'),
('Metallica', '1981-01-01', 'James Hetfield, Lars Ulrich, Kirk Hammett, Robert Trujillo', 'active', 'metal', 'Metallica is one of the most influential heavy metal bands of all time, with aggressive riffs and anthems like "Enter Sandman" and "Master of Puppets".'),
('Iron Maiden', '1975-01-01', 'Bruce Dickinson, Steve Harris, Dave Murray, Adrian Smith', 'active', 'metal', 'Iron Maiden is a pioneering heavy metal band, known for their complex compositions, theatrical live performances, and iconic albums like "The Number of the Beast".'),
('Pearl Jam', '1990-01-01', 'Eddie Vedder, Stone Gossard, Jeff Ament, Mike McCready', 'active', 'alt rock', 'Pearl Jam is a grunge and alternative rock band from Seattle, famed for their timeless albums "Ten" and "Vs." and powerful performances led by Eddie Vedder.'),
('The Who', '1964-01-01', 'Roger Daltrey, Pete Townshend, John Entwistle, Keith Moon', 'inactive', 'classic rock', 'The Who are pioneers of rock, known for their dynamic sound and conceptual albums like "Tommy" and "Quadrophenia". They helped define the genre in the 1960s and 1970s.');

-- insert additional rock band data
INSERT INTO bands (name, date_created, members, activity_status, genre, description) VALUES
('The Doors', '1965-01-01', 'Jim Morrison, Robby Krieger, Ray Manzarek, John Densmore', 'inactive', 'psychedelic rock', 'The Doors, led by Jim Morrison, were pioneers of psychedelic rock, blending blues, jazz, and rock with mystical lyrics. Hits like "Light My Fire" defined the 60s counterculture.'),
('Black Sabbath', '1968-01-01', 'Ozzy Osbourne, Tony Iommi, Geezer Butler, Bill Ward', 'inactive', 'metal', 'Black Sabbath is widely credited with creating heavy metal with their dark, heavy sound and groundbreaking albums like "Paranoid" and "Master of Reality".'),
('Queen', '1970-01-01', 'Freddie Mercury, Brian May, Roger Taylor, John Deacon', 'active', 'classic rock', 'Queen combined elements of rock, opera, and theater to create timeless hits like "Bohemian Rhapsody" and "We Are the Champions". Freddie Mercury became an icon of music and performance.'),
('The Clash', '1976-01-01', 'Joe Strummer, Mick Jones, Paul Simonon, Topper Headon', 'inactive', 'punk rock', 'The Clash were a groundbreaking punk band with politically charged lyrics and a musical blend of punk, reggae, and rockabilly. "London Calling" is a genre-defining album.'),
('The Velvet Underground', '1964-01-01', 'Lou Reed, John Cale, Sterling Morrison, Maureen Tucker', 'inactive', 'art rock', 'The Velvet Underground was an avant-garde rock band that influenced generations with their experimental music, and lyrics tackling taboo subjects. "Heroin" and "Sunday Morning" are iconic tracks.'),
('Oasis', '1991-01-01', 'Liam Gallagher, Noel Gallagher, Gem Archer, Andy Bell', 'inactive', 'britpop', 'Oasis, led by the Gallagher brothers, defined Britpop with their anthem "Wonderwall" and their rivalry with Blur. They became one of the UK\'s most successful bands of the 90s.'),
('The Smashing Pumpkins', '1988-01-01', 'Billy Corgan, James Iha, D’arcy Wretzky, Jimmy Chamberlin', 'active', 'alternative rock', 'The Smashing Pumpkins are known for their blend of alternative rock, grunge, and dream pop. Their album "Mellon Collie and the Infinite Sadness" is a masterpiece of 90s rock.'),
('Green Day', '1987-01-01', 'Billie Joe Armstrong, Mike Dirnt, Tre Cool', 'active', 'punk rock', 'Green Day brought punk rock back into the mainstream with their breakthrough album "Dookie" and later defined the pop-punk genre with "American Idiot".'),
('Radiohead', '1985-01-01', 'Thom Yorke, Jonny Greenwood, Ed O’Brien, Colin Greenwood, Philip Selway', 'active', 'alternative rock', 'Radiohead became known for their experimental approach to rock music, with albums like "OK Computer" and "Kid A" exploring the boundaries of rock and electronic music.'),
('The Cure', '1976-01-01', 'Robert Smith, Simon Gallup, Porl Thompson, Jason Cooper', 'active', 'gothic rock', 'The Cure, fronted by Robert Smith, became iconic in the goth rock scene with dark, atmospheric music, epitomized by hits like "Just Like Heaven" and "Lovesong".'),
('The Kinks', '1964-01-01', 'Ray Davies, Dave Davies, Mick Avory, Peter Quaife', 'inactive', 'rock', 'The Kinks are known for their British Invasion sound and storytelling, producing timeless songs like "You Really Got Me" and "Lola". Their influence on rock music is immense.'),
('The Arctic Monkeys', '2002-01-01', 'Alex Turner, Jamie Cook, Nick O’Malley, Matt Helders', 'active', 'indie rock', 'The Arctic Monkeys revolutionized indie rock with their debut "Whatever People Say I Am, That’s What I’m Not". Their witty lyrics and sharp guitar work made them international stars.'),
('Lynyrd Skynyrd', '1964-01-01', 'Ronnie Van Zant, Allen Collins, Gary Rossington, Leon Wilkeson', 'inactive', 'southern rock', 'Lynyrd Skynyrd became legends of southern rock with their southern anthems like "Sweet Home Alabama" and "Free Bird". Their music and legacy still influence rock today.'),
('The Black Keys', '2001-01-01', 'Dan Auerbach, Patrick Carney', 'active', 'blues rock', 'The Black Keys are known for their gritty blues-rock sound. With albums like "Brothers" and "El Camino", they became a leading force in the revival of garage and blues rock.'),
('Blur', '1988-01-01', 'Damon Albarn, Graham Coxon, Alex James, Dave Rowntree', 'active', 'britpop', 'Blur is a key band of the Britpop movement, known for their catchy, genre-blending hits like "Song 2" and "Girls and Boys". Their rivalry with Oasis defined the 90s UK music scene.'),
('The Strokes', '1998-01-01', 'Julian Casablancas, Nick Valensi, Albert Hammond Jr., Nikolai Fraiture, Fabrizio Moretti', 'active', 'indie rock', 'The Strokes led the early 2000s garage rock revival with their sharp, energetic sound and albums like "Is This It". They remain influential in the indie rock scene.'),
('Foo Fighters', '1994-01-01', 'Dave Grohl, Nate Mendel, Chris Shiflett, Taylor Hawkins', 'active', 'alt rock', 'The Foo Fighters, formed by former Nirvana drummer Dave Grohl, became a staple of 90s and 2000s rock with hits like "Everlong" and "Learn to Fly".'),
('My Chemical Romance', '2001-01-01', 'Gerard Way, Frank Iero, Mikey Way, Ray Toro', 'active', 'emo', 'My Chemical Romance are key figures in the emo and post-hardcore scenes, with their theatrical sound and hits like "Welcome to the Black Parade" and "I’m Not Okay".'),
('The Red Hot Chili Peppers', '1983-01-01', 'Anthony Kiedis, Flea, John Frusciante, Chad Smith', 'active', 'funk rock', 'The Red Hot Chili Peppers have been pioneers of combining funk, rock, and punk, with timeless albums like "Californication" and hits like "Under the Bridge".'),
('Rage Against the Machine', '1991-01-01', 'Zack de la Rocha, Tom Morello, Tim Commerford, Brad Wilk', 'active', 'rap rock', 'Rage Against the Machine is known for their politically charged rap-rock sound, blending heavy metal with rap. Their album "Rage Against the Machine" is a genre-defining classic.');
