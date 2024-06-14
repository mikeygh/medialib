CREATE TABLE `media` (
  `media_id` bigint(20) NOT NULL,
  `media_title` text NOT NULL,
  `media_type` text NOT NULL,

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`);

ALTER TABLE `media`
  MODIFY `media_id` bigint(20) NOT NULL AUTO_INCREMENT;