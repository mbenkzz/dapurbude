CREATE TABLE transaction (
    id serial not null,
    `code` varchar(16) not null,
    disc numeric(10,0) default 0,
    total numeric(10,0) not null,
    created_at timestamp,
    created_by varchar(16),
    deleted_at timestamp null default null,
    deleted_by varchar(16) default null,
    delete_reason varchar(255) default null,
    primary key (id),
    unique (`code`)
);
