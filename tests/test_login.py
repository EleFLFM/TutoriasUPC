import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


@pytest.fixture
def driver():
    # Configura el WebDriver para Chrome
    driver = webdriver.Chrome()
    driver.get("http://localhost/TutoriasUPC/login.html")
    yield driver
    driver.quit()


def test_login_correct(driver):
    # Ingreso de datos correctos
    driver.find_element(By.NAME, "usuario").send_keys("elef")  # Reemplaza con un usuario real
    driver.find_element(By.NAME, "contraseña").send_keys("admin")  # Reemplaza con la contraseña real
    driver.find_element(By.XPATH, "//button").click()

    # Verificar redirección al panel de administrador
    WebDriverWait(driver, 10).until(EC.url_contains("under/index_admin.php"))
    assert "under/index_admin.php" in driver.current_url


def test_login_incorrect(driver):
    # Ingreso de datos incorrectos
    driver.find_element(By.NAME, "usuario").send_keys("usuario_falso")
    driver.find_element(By.NAME, "contraseña").send_keys("contraseña_falsa")
    driver.find_element(By.XPATH, "//button").click()

    # Verificar el mensaje de error
    alert = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, "swal2-title")))
    assert "Error" in alert.text


def test_login_inactive_user(driver):
    # Ingreso de datos de un usuario inactivo
    driver.find_element(By.NAME, "usuario").send_keys("docenteprueba")  # Reemplaza con un usuario real
    driver.find_element(By.NAME, "contraseña").send_keys("docenteprueba")  # Contraseña real
    driver.find_element(By.XPATH, "//button").click()

    # Verificar el mensaje de usuario inactivo
    alert = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, "swal2-title")))
    assert "Usuario Inactivo" in alert.text