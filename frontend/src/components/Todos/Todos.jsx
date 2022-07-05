import React, { useEffect, useState } from "react";
import { deleteTodo, fetchAllTodos, filterByStatus } from "../../api/todo";
import {
  Button,
  Card,
  Col,
  Empty,
  Input,
  Row,
  Select,
  Space,
  Typography,
} from "antd";
import Spinner from "../Spinner/Spinner";
import "./style.css";
import TodoItem from "./TodoItem";
import { ReloadOutlined } from "@ant-design/icons";

const Todos = () => {
  const [loading, setLoading] = useState(false);
  const [todos, setTodos] = useState([]);
  const [search, setSearch] = useState("");
  const [status, setStatus] = useState("");

  useEffect(() => {
    setLoading(true);
    fetchAllTodos()
      .then((data) => {
        setTodos(data);
        setLoading(false);
      })
      .catch((err) => console.log(err));
  }, []);

  useEffect(() => {
    setLoading(true);
    if (status.length)
      filterByStatus(status)
        .then((data) => {
          setTodos(data);
          setLoading(false);
        })
        .catch((err) => console.log(err));
  }, [status, setStatus]);

  const handleDelete = async (id) => {
    deleteTodo({ ids: [id] })
      .then(() => {
        setTodos(todos.filter((t) => t.id !== id));
      })
      .catch((err) => console.log(err));
  };

  const handleSearchChange = (e) => {
    setSearch(e.target.value.toLowerCase());
  };

  const handleStatusChange = (e) => {
    setStatus(e);
  };

  const handleReset = (e) => {
    setStatus("");
    setLoading(true);
    fetchAllTodos()
      .then((data) => {
        setTodos(data);
        setLoading(false);
      })
      .catch((err) => console.log(err));
  };

  const Todos = todos
    .filter((todo) => {
      return (
        todo.name.toLowerCase().includes(search) ||
        todo.description.toLowerCase().includes(search)
      );
    })
    .map((todo) => (
      <Col
        lg={{ span: 6 }}
        md={{ span: 8 }}
        sm={{ span: 12 }}
        xs={{ span: 24 }}
        key={todo.id}
      >
        <TodoItem todo={todo} handleDelete={handleDelete} />
      </Col>
    ));

  return (
    <Card
      title={<Typography.Title level={2}>Todos List</Typography.Title>}
      bordered={false}
    >
      <Row>
        <Col span={6}>
          <Typography.Title level={3} strong>
            Filter By Status :
          </Typography.Title>
        </Col>
        <Col span={6}>
          <Space size="large">
            <Select
              value={status}
              defaultValue=""
              onChange={handleStatusChange}
              style={{ width: 150 }}
            >
              <Select.Option value="" disabled>
                Select Status...
              </Select.Option>
              <Select.Option value="todo">TODO</Select.Option>
              <Select.Option value="in-progress">IN-PROGRESS</Select.Option>
              <Select.Option value="done">DONE</Select.Option>
            </Select>
            <Button
              type="default"
              shape="circle"
              icon={<ReloadOutlined />}
              size="middle"
              onClick={handleReset}
            />
          </Space>
        </Col>
        <Col span={4} offset={8}>
          <Input placeholder="Search..." onChange={handleSearchChange} />
        </Col>
      </Row>
      <Row gutter={[24, 14]}>
        {loading && <Spinner />}
        {!loading && todos.length === 0 && (
          <Empty style={{ margin: "0 auto" }} />
        )}
        {!loading && todos.length !== 0 && Todos}
      </Row>
    </Card>
  );
};

export default Todos;
