DECLARE
  cursor c_emp as select * from E_employee;
  v_emp E_employee%ROWtype;
  v_aug E_employee.salaire%type;
BEGIN
  open c_emp;
  loop
    fetch c_emp into v_emp;
      if(to_char(v_emp.hiredate,'yyyy') = '1995') then v_aug = v_emp*0.1;
      elsif(to_char(v_emp.hiredate,'yyyy') = '1996') then v_aug = v_emp*0.2;
      else v_aug =0;
      end if;
      update E_employee set salaire = salaire + v_aug;
      insert into E_aug value(seq.nextval,v_aug,sysdate,v_emp.num);
      exit when c_emp%notfound ;
  end loop;
  close c_emp;
end;
  ----------------------------------------------------
ACCEPT p_sal PROMPT 'Entrer le salaire : '
DECLARE
  cursor c_emp(v_sal E_employee.salaire%type) as
    select * from E_employee where salaire > v_sal;
BEGIN
  for v_emp in c_emp loop
      insert into E_results values(seq.nextval,v_emp.nom || ' a un salaire >' || '&p_sal',v_emp.salaire);
  end loop;
end;
----------------------------------------------------
DECLARE
  cursor c_emp as
   select E_employee.nom,sum(E_commande.total) as CountCommande
   from E_employee,E_commande
   where E_employee.No = E_commande.CNO
   group by E_commande.CNO;
BEGIN
  for v_emp in c_emp loop
    insert into E_results values(seq.nextval,v_emp.nom|| ' totalise',v_emp.CountCommande);
  end loop;
end;
----------------------------------------------------
DECLARE
  cursor c_produit as
    select * from produit where no in (select no from E_produit minus select produit_no from E_ligne);
BEGIN
  for v_produit in c_produit loop
    update produit set prix*=0.7 where current of c_produit;
    insert into E_results values(seq.nextval,v_produit.no || ' - '|| v_produit.name || ' baisse de 30%',v_produit.prix);
  end loop;
end;
----------------------------------------------------
ACCEPT p_client PROMPT "NUM client :";
DECLARE
v_name E_employee.name%type;
v_montantTotale E_employee.name%type;
v_montant E_employee.name%type;
BEGIN
      select name into v_name from E_employee where idClinet = '&p_client';
      select sum(total) into v_montantTotale from E_commande;
      select sum(total) into v_montant from where idClinet = '&p_client';
      insert into E_results values(seq.nextval,"Rapport de commande du client " || v_name,v_montantTotale/v_montant);
EXCEPTION
      when TOO_MANY_ROWS THEN DBMS.OUTPUT.PUT_LINE(' TOO MANY ROWS');
      when NO_DATA_FOUND THEN DBMS.OUTPUT.PUT_LINE(' NO DATA FOUND');
      when ZERO_DEVIDE THEN DBMS.OUTPUT.PUT_LINE(' Montant de client equals sifr');
end;
----------------------------------------------------
ACCEPT p_client PROMPT "NUM client :";
DECLARE
v_name E_employee.name%type;
v_montantTotale E_employee.name%type;
v_montant E_employee.name%type;
e_dataNotFound  EXCEPTION;
e_tooManyRows  EXCEPTION;
e_devideZero  EXCEPTION;
e_devideZeroByZero  EXCEPTION;
PRAGMA EXCEPTION_INIT(e_dataNotFound,1403);
PRAGMA EXCEPTION_INIT(e_tooManyRows,-1422);
PRAGMA EXCEPTION_INIT(e_devideZero,-1476);
BEGIN
      select name into v_name from E_employee where idClinet = '&p_client';
      select sum(total) into v_montantTotale from E_commande;
      select sum(total) into v_montant from where idClinet = '&p_client';
      if(v_montant == 0 && v_montantTotale==0 ) then
        RAISE e_devideZeroByZero;
      end if;
      insert into E_results values(seq.nextval,'Rapport de commande du client ' || v_name,v_montantTotale/v_montant);
EXCEPTION
      when e_tooManyRows THEN DBMS.OUTPUT.PUT_LINE(' TOO MANY ROWS');
      when e_dataNotFound THEN DBMS.OUTPUT.PUT_LINE(' NO DATA FOUND');
      when e_devideZero THEN DBMS.OUTPUT.PUT_LINE(' Montant de client equals sifr');
      when e_devideZeroByZero THEN DBMS.OUTPUT.PUT_LINE(' sifr / sifr = +8 m9loba');
end;
-----------------------------------------------------
CREATE FUNCTION totalME(NumClient Number) return number is
  total number;
  totalme number;
  e_devideZero EXCEPTION;
  BEGIN
    select sum(total) into total from E_commande;
    select sum(total) into totalme from E_commande where idClinet = NumClient;
    if(total == 0) then
      RAISE e_devideZero;
    end if;
    return total/totalme;
  EXCEPTION
    when e_devideZero then DBMS.OUTPUT.PUT_LINE('SIIIFR');
end totalMe;
-----------------------------------------------------
CREATE PROCEDURE totalME(NumClient in Number,total out number) is
  BEGIN
    select sum(total) into total from E_commande;
    select sum(total) into totalme from E_commande where idClinet = NumClient;
    if(totalme == 0) then
      RAISE_APPLICATION_ERROR(20142,'The Answer of the universe');
    end if;
    total := total/totalme;
end totalMe;

DECLARE
  NCL NUMBER;
  total NUMBER;
  e_procExpection EXCEPTION;
  PRAGMA EXCEPTION_INIT(e_procExpection,20142);
BEGIN
    totalMe(2,total);
    DBMS.OUTPUT.PUT_LINE('Total is '|| total);
EXCEPTION
  when e_procExpection then DBMS.OUTPUT.PUT_LINE('SIIIFR');
END
-----------------------------------------------------
CREATE PROCEDURE Sup_emp(NumClient in Number) is
  e_noData exception;
  PRAGMA EXCEPTION_INIT (e_integrity, -2292);
  BEGIN
    delete from E_employee where id = NumClient;
  exception
    when e_noData then DBMS.OUTPUT.PUT_LINE('-----');
end Sup_emp;

DECLARE
  NCL NUMBER;
BEGIN
    Sup_emp(2,total);
END
-----------------------------------------------------
Créer la table Trace_Salaire suivante :
Trace_Salaire( No_emp Number,
AncienSal Number(7,2),
NouveauSal Number(7,2),
Date_Modif Date,
Commentaire Varchar(30)
) ;

CREATE OR REPLACE TRIGGER changer_salaire
BEFORE DELETE OR INSERT OR UPDATE ON E_employee
FOR EACH ROW
WHEN (NEW.ID > 0)
DECLARE
   sal_diff number;
BEGIN
   sal_diff := :NEW.salary  - :OLD.salary;
   dbms_output.put_line('Old salary: ' || :OLD.salary);
   dbms_output.put_line('New salary: ' || :NEW.salary);
   dbms_output.put_line('Salary difference: ' || sal_diff);
END;
/
