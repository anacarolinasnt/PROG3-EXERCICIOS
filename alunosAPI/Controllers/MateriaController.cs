using System.Collections.Generic;
using alunosAPI.Models;
using alunosAPI.Repository;
using Microsoft.AspNetCore.Mvc;

namespace alunosAPI.Controllers
{
    [Route("api/[Controller]")] //no navegador fica assim: https://localhost:5001/api/Materia
    public class MateriaController : Controller
    {
        //Atributos:
        private readonly IMateriaRepository materiaRepository;
        //Construtor:
        public MateriaController(IMateriaRepository materiaRepository)
        {
            this.materiaRepository = materiaRepository;
        }

        [HttpGet]
        public IEnumerable<Materia> GetAll()
        {
            return materiaRepository.GetAll();
        }

        [HttpGet("{idmaterias}", Name = "GetMateria")]
        public IActionResult GetById(long idmaterias)
        {
            // Buscando no materiaRepository pelo Id enviado no parametro
            var materia = materiaRepository.Find(idmaterias);
            if (materia == null)
                //Checagem se for nulo
                return NotFound(); //ERRO: 404
            return new ObjectResult(materia);
        }

        [HttpPost]
        public IActionResult Create([FromBody] Materia materia)
        {
            // Recebendo objeto materia no parametro
            if (materia == null)
                return BadRequest(); //ERRO: 400
            // Adicionando ao repositorio caso não seja nulo
            materiaRepository.Add(materia);
            // Criação da rota
            return CreatedAtRoute("GetPessoa", new { idmaterias = materia.idmaterias }, materia);
        }

        [HttpPut]
        public IActionResult Update([FromBody] Materia materia)
        {
            // Recebe o objeto materia no parametro e busca no repositório para fazer o update
            var materiaUpdate = materiaRepository.Find(materia.idmaterias);
            if (materiaUpdate == null)
                return NotFound(); //ERRO: 404
            if (materia == null || materiaUpdate.idmaterias != materia.idmaterias)
                return BadRequest(); //ERRO: 400

            // Atualizar nome, periodo, carga horária de acordo com o idmaterias
            materiaUpdate.nome = materia.nome;
            materiaUpdate.periodo = materia.periodo;
            materiaUpdate.carga_horaria = materia.carga_horaria;
            materiaRepository.Update(materiaUpdate);
            return new NoContentResult(); //SUCESSO: 204
        }

        [HttpDelete("{idmaterias}")]
        public IActionResult Delete(long idmaterias)
        {
            // Fazer a deleção da materia de acordo com o seu id
            var materiaDelete = materiaRepository.Find(idmaterias);
            if (materiaDelete == null)
                return NotFound(); //ERRO: 404
            materiaRepository.Remove(idmaterias);
            return new NoContentResult(); //SUCESSO: 204
        }
    }
}