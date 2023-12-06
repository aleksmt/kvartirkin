
BEGIN;

-----------------------------------------------------------------------
-- kvartirkin.bot_users
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "kvartirkin"."bot_users" CASCADE;

CREATE TABLE "kvartirkin"."bot_users"
(
    "id" bigserial NOT NULL,
    "t_id" INT8 NOT NULL,
    "t_name" TEXT,
    "t_last_message" VARCHAR,
    "t_bot_active" BOOLEAN DEFAULT 't',
    "t_from_time" TIME DEFAULT '10:00:00',
    "t_to_time" TIME DEFAULT '22:00:00',
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- kvartirkin.bot_active_parsers
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "kvartirkin"."bot_active_parsers" CASCADE;

CREATE TABLE "kvartirkin"."bot_active_parsers"
(
    "class" TEXT NOT NULL,
    "active" BOOLEAN DEFAULT 'f',
    "last_run_ts" TIMESTAMP DEFAULT '1970-01-01 00:00:00',
    "from_time" TIME DEFAULT '10:00:00',
    "to_time" TIME DEFAULT '22:00:00',
    PRIMARY KEY ("class")
);

COMMIT;
