--
-- PostgreSQL database dump
--

CREATE DATABASE "CRUD";


ALTER DATABASE "CRUD" OWNER TO postgres;


ALTER SCHEMA public OWNER TO postgres;

SET default_tablespace = '';

--
-- TOC entry 196 (class 1259 OID 118797078)
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona (
    id_persona character varying(20) NOT NULL,
    cedula character varying(8),
    nombre character varying(150),
    telefono character varying(11),
    direccion character varying(250),
    email character varying(200)
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 233715284)
-- Name: prueba; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prueba (
    id_prueba character varying(20) NOT NULL,
    dato1 text,
    dato2 text
);


ALTER TABLE public.prueba OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 138212433)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario character varying(10) NOT NULL,
    username character varying(20),
    passkey text,
    estatus character varying(10)
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 2911 (class 0 OID 118797078)
-- Dependencies: 196
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2913 (class 0 OID 233715284)
-- Dependencies: 198
-- Data for Name: prueba; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2912 (class 0 OID 138212433)
-- Dependencies: 197
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuarios VALUES ('USER_ADMIN', 'admin', '$2y$10$cUz1mpk9bTlp1Qswp4QIZOzP5ROXAVMBTSzs8.ufntfoCC8GYMMcG', 'ACTIVO');


--
-- TOC entry 2785 (class 2606 OID 118797085)
-- Name: persona persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id_persona);


--
-- TOC entry 2789 (class 2606 OID 233715291)
-- Name: prueba prueba_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prueba
    ADD CONSTRAINT prueba_pkey PRIMARY KEY (id_prueba);


--
-- TOC entry 2787 (class 2606 OID 138212440)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- TOC entry 2920 (class 0 OID 0)
-- Dependencies: 7
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2022-12-08 22:13:00 -04

--
-- PostgreSQL database dump complete
--

