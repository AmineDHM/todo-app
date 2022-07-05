import { Button, Form, Input, Select } from "antd";
import React from "react";

const TodoForm = ({ todo, onSubmit, loading }) => {
  return (
    <Form
      name="basic"
      labelCol={{
        span: 8,
      }}
      wrapperCol={{
        span: 8,
      }}
      initialValues={
        todo && {
          name: todo.name,
          description: todo.description,
          priority: todo.priority.toString(),
          status: todo.status,
          color: todo.color,
        }
      }
      onFinish={(values) => onSubmit(values)}
      autoComplete="off"
    >
      <Form.Item
        label="Title"
        name="name"
        rules={[
          {
            required: true,
            message: "Please input your todo title!",
          },
        ]}
      >
        <Input />
      </Form.Item>

      <Form.Item
        label="Description"
        name="description"
        rules={[
          {
            required: true,
            message: "Please input your todo description!",
          },
        ]}
      >
        <Input.TextArea />
      </Form.Item>

      <Form.Item
        label="Color"
        name="color"
        rules={[
          {
            required: true,
            message: "Please input your todo color!",
          },
        ]}
      >
        <Input />
      </Form.Item>

      <Form.Item
        label="Priority"
        name="priority"
        rules={[
          {
            required: true,
            message: "Please input your todo priority!",
          },
        ]}
      >
        <Select>
          <Select.Option value="low">Low</Select.Option>
          <Select.Option value="meduim">Meduim</Select.Option>
          <Select.Option value="high">High</Select.Option>
        </Select>
      </Form.Item>

      {todo && (
        <Form.Item
          label="Status"
          name="status"
          rules={[
            {
              required: true,
              message: "Please input your todo status!",
            },
          ]}
        >
          <Select>
            <Select.Option value="todo">TODO</Select.Option>
            <Select.Option value="in-progress">IN-PROGRESS</Select.Option>
            <Select.Option value="done">DONE</Select.Option>
          </Select>
        </Form.Item>
      )}

      <Form.Item
        wrapperCol={{
          offset: 8,
          span: 8,
        }}
      >
        <Button type="primary" htmlType="submit" loading={loading}>
          Submit
        </Button>
        <Button type="ghost" htmlType="reset" style={{ marginLeft: 20 }}>
          Reset
        </Button>
      </Form.Item>
    </Form>
  );
};

export default TodoForm;
