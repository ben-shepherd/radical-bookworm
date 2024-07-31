<?php

declare(strict_types=1);

namespace App\Domains\Books\Faker;

class FakeListResponse
{
    public function toArray(): array
    {
        return json_decode(
            <<<EOF
{
  "status": "OK",
  "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
  "num_results": 15,
  "last_modified": "2024-07-31T15:05:11-04:00",
  "results": [
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 1,
      "rank_last_week": 1,
      "weeks_on_list": 65,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1538742578?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1538742578",
          "isbn13": "9781538742570"
        },
        {
          "isbn10": "1538768542",
          "isbn13": "9781538768549"
        },
        {
          "isbn10": "1803144386",
          "isbn13": "9781803144382"
        }
      ],
      "book_details": [
        {
          "title": "THE HOUSEMAID",
          "description": "Troubles surface when a woman looking to make a fresh start takes a job in the home of the Winchesters.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Grand Central",
          "primary_isbn13": "9781538742570",
          "primary_isbn10": "1538742578"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 2,
      "rank_last_week": 5,
      "weeks_on_list": 163,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "http://www.amazon.com/Ends-Us-Novel-Colleen-Hoover-ebook/dp/B0176M3U10?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1501110365",
          "isbn13": "9781501110368"
        },
        {
          "isbn10": "1501110373",
          "isbn13": "9781501110375"
        },
        {
          "isbn10": "1982143657",
          "isbn13": "9781982143657"
        },
        {
          "isbn10": "1508212694",
          "isbn13": "9781508212690"
        },
        {
          "isbn10": "1797107453",
          "isbn13": "9781797107455"
        },
        {
          "isbn10": "1804228206",
          "isbn13": "9781804228203"
        },
        {
          "isbn10": "1432899791",
          "isbn13": "9781432899790"
        },
        {
          "isbn10": "1668021048",
          "isbn13": "9781668021040"
        },
        {
          "isbn10": "1471156273",
          "isbn13": "9781471156274"
        }
      ],
      "book_details": [
        {
          "title": "IT ENDS WITH US",
          "description": "A battered wife raised in a violent home attempts to halt the cycle of abuse.",
          "contributor": "by Colleen Hoover",
          "author": "Colleen Hoover",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Atria",
          "primary_isbn13": "9781501110368",
          "primary_isbn10": "1501110365"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 3,
      "rank_last_week": 3,
      "weeks_on_list": 15,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "http://www.amazon.com/Court-Thorns-Roses-Sarah-Maas-ebook/dp/B00OZP5VRS?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1619634457",
          "isbn13": "9781619634459"
        },
        {
          "isbn10": "1635575567",
          "isbn13": "9781635575569"
        },
        {
          "isbn10": "1635575559",
          "isbn13": "9781635575552"
        }
      ],
      "book_details": [
        {
          "title": "A COURT OF THORNS AND ROSES",
          "description": "After killing a wolf in the woods, Feyre is taken from her home and placed inside the world of the Fae.",
          "contributor": "by Sarah J. Maas",
          "author": "Sarah J. Maas",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Bloomsbury",
          "primary_isbn13": "9781635575569",
          "primary_isbn10": "1635575567"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 4,
      "rank_last_week": 2,
      "weeks_on_list": 6,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1464221138?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1464221138",
          "isbn13": "9781464221132"
        }
      ],
      "book_details": [
        {
          "title": "THE HOUSEMAID IS WATCHING",
          "description": "The third book in the Housemaid series. Dangers lurk in a quiet neighborhood.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Poisoned Pen",
          "primary_isbn13": "9781464221132",
          "primary_isbn10": "1464221138"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 5,
      "rank_last_week": 4,
      "weeks_on_list": 9,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/0349132615?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "",
          "isbn13": ""
        },
        {
          "isbn10": "0349132615",
          "isbn13": "9780349132617"
        },
        {
          "isbn10": "1837901325",
          "isbn13": "9781837901326"
        }
      ],
      "book_details": [
        {
          "title": "THE HOUSEMAID'S SECRET",
          "description": "The second book in the Housemaid series. The sound of crying and the appearance of blood portend misdeeds.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Mobius",
          "primary_isbn13": "9780349132617",
          "primary_isbn10": "0349132615"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 6,
      "rank_last_week": 0,
      "weeks_on_list": 12,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1728296161?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1728296161",
          "isbn13": "9781728296166"
        },
        {
          "isbn10": "1088057969",
          "isbn13": "9781088057964"
        }
      ],
      "book_details": [
        {
          "title": "NEVER LIE",
          "description": "A winter storm traps a pair of newlyweds in a remote manor whose previous owner mysteriously disappeared.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Poisoned Pen",
          "primary_isbn13": "9781728296166",
          "primary_isbn10": "1728296161"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 7,
      "rank_last_week": 9,
      "weeks_on_list": 58,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1728274869?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1728274869",
          "isbn13": "9781728274867"
        }
      ],
      "book_details": [
        {
          "title": "TWISTED LOVE",
          "description": "The first book in the Twisted series. Secrets emerge when Ava explores things with her brother’s best friend.",
          "contributor": "by Ana Huang",
          "author": "Ana Huang",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Bloom",
          "primary_isbn13": "9781728274867",
          "primary_isbn10": "1728274869"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 8,
      "rank_last_week": 0,
      "weeks_on_list": 15,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1728296218?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1728296218",
          "isbn13": "9781728296210"
        }
      ],
      "book_details": [
        {
          "title": "THE TEACHER",
          "description": "A math teacher at Caseham High suspects there is more going on behind a scandal involving a teacher and a student.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Poisoned Pen",
          "primary_isbn13": "9781728296210",
          "primary_isbn10": "1728296218"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 9,
      "rank_last_week": 14,
      "weeks_on_list": 12,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/172829617X?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "172829617X",
          "isbn13": "9781728296173"
        },
        {
          "isbn10": "1087905710",
          "isbn13": "9781087905716"
        }
      ],
      "book_details": [
        {
          "title": "THE INMATE",
          "description": "A nurse practitioner at a maximum-security prison gave testimony against her former boyfriend that put him behind bars.",
          "contributor": "by Freida McFadden",
          "author": "Freida McFadden",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Poisoned Pen",
          "primary_isbn13": "9781728296173",
          "primary_isbn10": "172829617X"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 10,
      "rank_last_week": 0,
      "weeks_on_list": 1,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/0063308436?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "0063308436",
          "isbn13": "9780063308435"
        },
        {
          "isbn10": "0063308444",
          "isbn13": "9780063308442"
        },
        {
          "isbn10": "0063308428",
          "isbn13": "9780063308428"
        }
      ],
      "book_details": [
        {
          "title": "THE AU PAIR AFFAIR",
          "description": "The second book in the Big Shots series. A hockey veteran who recently became a single dad becomes attracted to his live-in nanny.",
          "contributor": "by Tessa Bailey",
          "author": "Tessa Bailey",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Avon",
          "primary_isbn13": "9780063308435",
          "primary_isbn10": "0063308436"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 11,
      "rank_last_week": 7,
      "weeks_on_list": 15,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1635575583?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1619634473",
          "isbn13": "9781619634473"
        },
        {
          "isbn10": "1619635194",
          "isbn13": "9781619635197"
        },
        {
          "isbn10": "1635575583",
          "isbn13": "9781635575583"
        },
        {
          "isbn10": "1635575575",
          "isbn13": "9781635575576"
        }
      ],
      "book_details": [
        {
          "title": "A COURT OF MIST AND FURY",
          "description": "The second book in the Court of Thorns and Roses series. Feyre gains the powers of the High Fae and a greater evil emerges.",
          "contributor": "by Sarah J. Maas",
          "author": "Sarah J. Maas",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Bloomsbury",
          "primary_isbn13": "9781635575583",
          "primary_isbn10": "1635575583"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 12,
      "rank_last_week": 6,
      "weeks_on_list": 16,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1538704439?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1538704439",
          "isbn13": "9781538704431"
        },
        {
          "isbn10": "1538768631",
          "isbn13": "9781538768631"
        },
        {
          "isbn10": "1538767449",
          "isbn13": "9781538767443"
        },
        {
          "isbn10": "153876864X",
          "isbn13": "9781538768648"
        },
        {
          "isbn10": "1549135147",
          "isbn13": "9781549135149"
        }
      ],
      "book_details": [
        {
          "title": "JUST FOR THE SUMMER",
          "description": "Justin and Emma, whose exes find soulmates after breaking up with them, have a fling on a private island on Lake Minnetonka.",
          "contributor": "by Abby Jimenez",
          "author": "Ab Jimenez",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Forever",
          "primary_isbn13": "9781538704431",
          "primary_isbn10": "1538704439"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 13,
      "rank_last_week": 11,
      "weeks_on_list": 3,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/0593321200?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "0593321200",
          "isbn13": "9780593321201"
        },
        {
          "isbn10": "0593321219",
          "isbn13": "9780593321218"
        },
        {
          "isbn10": "0593591631",
          "isbn13": "9780593591635"
        },
        {
          "isbn10": "0593466497",
          "isbn13": "9780593466490"
        }
      ],
      "book_details": [
        {
          "title": "TOMORROW, AND TOMORROW, AND TOMORROW",
          "description": "Two friends find their partnership challenged in the world of video game design.",
          "contributor": "by Gabrielle Zevin",
          "author": "Gabrielle Zevin",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Vintage",
          "primary_isbn13": "9780593689646",
          "primary_isbn10": "None"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 14,
      "rank_last_week": 10,
      "weeks_on_list": 74,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1668001225?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1668001225",
          "isbn13": "9781668001226"
        },
        {
          "isbn10": "1668001233",
          "isbn13": "9781668001233"
        },
        {
          "isbn10": "179714510X",
          "isbn13": "9781797145105"
        }
      ],
      "book_details": [
        {
          "title": "IT STARTS WITH US",
          "description": "In the sequel to “It Ends With Us,” Lily deals with her jealous ex-husband as she reconnects with her first boyfriend.",
          "contributor": "by Colleen Hoover",
          "author": "Colleen Hoover",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Atria",
          "primary_isbn13": "9781668001226",
          "primary_isbn10": "1668001225"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    },
    {
      "list_name": "Trade Fiction Paperback",
      "display_name": "Paperback Trade Fiction",
      "bestsellers_date": "2024-07-20",
      "published_date": "2024-08-04",
      "rank": 15,
      "rank_last_week": 0,
      "weeks_on_list": 14,
      "asterisk": 0,
      "dagger": 0,
      "amazon_product_url": "https://www.amazon.com/dp/1728274877?tag=thenewyorktim-20",
      "isbns": [
        {
          "isbn10": "1728274877",
          "isbn13": "9781728274874"
        }
      ],
      "book_details": [
        {
          "title": "TWISTED GAMES",
          "description": "The second book in the Twisted series. A princess and an elite bodyguard find themselves experiencing a forbidden love.",
          "contributor": "by Ana Huang",
          "author": "Ana Huang",
          "contributor_note": "",
          "price": "0.00",
          "age_group": "",
          "publisher": "Bloom",
          "primary_isbn13": "9781728274874",
          "primary_isbn10": "1728274877"
        }
      ],
      "reviews": [
        {
          "book_review_link": "",
          "first_chapter_link": "",
          "sunday_review_link": "",
          "article_chapter_link": ""
        }
      ]
    }
  ]
}
EOF, true);
    }
}
