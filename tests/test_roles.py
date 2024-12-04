import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


@pytest.fixture
def driver():
    # Configura el WebDriver para Chrome
    driver = webdriver.Chrome()
    yield driver
    driver.quit()


def test_admin_role(driver):
    # Login como administrador
    driver.get("http://localhost/TutoriasUPC/login.html")
    driver.find_element(By.NAME, "usuario").send_keys("elef")  # Reemplaza con un usuario real
    driver.find_element(By.NAME, "contraseña").send_keys("admin")  # Contraseña real
    driver.find_element(By.XPATH, "//button").click()

    # Verificar redirección al panel de administrador
    WebDriverWait(driver, 10).until(EC.url_contains("under/index_admin.php"))
    assert "under/index_admin.php" in driver.current_url


def test_student_role(driver):
    # Login como estudiante
    driver.get("http://localhost/TutoriasUPC/login.html")
    driver.find_element(By.NAME, "usuario").send_keys("pruebaestudiante")  # Usuario real
    driver.find_element(By.NAME, "contraseña").send_keys("pruebaestudiante1")  # Contraseña real
    driver.find_element(By.XPATH, "//button").click()

    # Verificar redirección al panel de estudiante
    WebDriverWait(driver, 10).until(EC.url_contains("under/index_student.php"))
    assert "under/index_student.php" in driver.current_url


def test_teacher_role(driver):
    # Login como docente
    driver.get("http://localhost/TutoriasUPC/login.html")
    driver.find_element(By.NAME, "usuario").send_keys("docente")  # Usuario real
    driver.find_element(By.NAME, "contraseña").send_keys("docente")  # Contraseña real
    driver.find_element(By.XPATH, "//button").click()

    # Verificar redirección al panel de docente
    WebDriverWait(driver, 10).until(EC.url_contains("under/gestion_cursos_teacher.php"))
    assert "under/gestion_cursos_teacher.php" in driver.current_url